<?php 
isFieldFilled($_POST['first_name']);
isFieldFilled($_POST['last_name']);
isFieldFilled($_POST['email']);
isFieldFilled($_POST['gender']);

//var_dump($_POST);

$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$name = $firstName.$lastName;
$email = $_POST['email'];
$gender = $_POST['gender'];
$selectedOption = $_POST['selected_option'];
$multipleSelection = $_POST['multiple_selection'];
$comment = $_POST['comment'];
$language = $_POST['language'];

displayMessage($name,$email,$gender,$selectedOption,$multipleSelection,$comment,$language);



function displayMessage($name,$email,$gender,$selectedOption,$multipleSelection,$comment,$language){
	echo "the name is ".$name." ,the email address is ".$email. " ,gender is " .$gender. " ,the selected option is " .$selectedOption. " and comment is ".$comment."</br>";
	displayArrayInformation($multipleSelection);
	displayArrayInformation($language);
}

function isFieldFilled($value){
	if(!isset($value)){
		header("location: http://localhost/php_tutorial/php_for_web_dev/form_processing/");
	}
}

function displayArrayInformation($selection){
	if(is_array($selection)){
		foreach ($selection as $value) {
			echo $value."</br>";
		}
	}
}

 ?>