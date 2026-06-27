<?php 

global $errors;
$errors = array();
if (isset($_POST['submit'])) {
	validateName($_POST['first_name'],"First name must be valid", "first_name");
	validateName($_POST['last_name'],"Last name must be valid", "last_name");
	validateEmailAddress($_POST['email'],"Email address must be valid", "email");
	isFieldFilled($_POST['gender'] ?? "","please choose one","gender");

	$firstName = $_POST['first_name'];
	$lastName = $_POST['last_name'];
	$name = $firstName.$lastName;
	$email = $_POST['email'];
	$gender = $_POST['gender'] ?? "";
	$selectedOption = $_POST['selected_option'];
	$multipleSelection = $_POST['multiple_selection'] ?? [];
	$comment = $_POST['comment'];
	$language = $_POST['language'] ?? [];

	global $errors;
	if (empty($errors)) {
	displayMessage($name,$email,$gender,$selectedOption,$multipleSelection,$comment,$language);
	}else {
	//$errors;
		//header("location: http://localhost/php_tutorial/php_for_web_dev/form_processing/");
	}
}

function displayInputValue($key){
	if(isset($_POST[$key])){
		echo $_POST[$key];
	}
}

function displayErrorMessage($key){
	global $errors;
	if(array_key_exists($key, $errors)){
		echo $errors[$key];
	}
}

function displayMessage($name,$email,$gender,$selectedOption,$multipleSelection,$comment,$language){
	echo "the name is ".$name." ,the email address is ".$email. " ,gender is " .$gender. " ,the selected option is " .$selectedOption. " and comment is ".$comment."</br>";
	displayArrayInformation($multipleSelection);
	displayArrayInformation($language);
}

function validateName($name,$error,$key){
	if (empty($name) || !preg_match("/^[a-zA-Z-' ]*$/",$name)) {
		global $errors;
		$errors[$key] = $error;
  		//header("location: http://localhost/php_tutorial/php_for_web_dev/form_processing/");
  	}
}

function isFieldFilled($value,$error,$key){
	if (empty($value)) {
		global $errors;
		$errors[$key] = $error;
		//header("location: http://localhost/php_tutorial/php_for_web_dev/form_processing/");
	}
}

function validateEmailAddress($email,$error,$key){
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		global $errors;
		$errors[$key] = $error;
  		//header("location: http://localhost/php_tutorial/php_for_web_dev/form_processing/");
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