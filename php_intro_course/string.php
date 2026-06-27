<?php 
/*
function isPalindrome($word){
	$array = str_split($word);
	if(count($array) == 0){
		return true;
	}
	$start = 0;
	$end = count($array) -1;

	while ($start < $end) {
		if ($array[$start] == $array[$end]) {
			$start++;
			$end--;
		}else{
			return false;
		}
	}
	return true;
}
*/

//Simple function for this
function isPalindrome($word){
	$reversedString = strrev($word);
	$status = strcasecmp($word, $reversedString);
	if ($status == 0) {
		return true;
	}else{
		return false;
	}
}

$status = isPalindrome("attack");
if ($status) {
	echo "this is a palindrome";
}else{
	echo "this is not a palindrome";
}

 ?>