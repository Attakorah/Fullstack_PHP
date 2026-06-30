<?php
declare(strict_types=1);

session_start();
require_once __DIR__ . '/data.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

$required = [
    'first_name' => 'First name',
    'middle_name' => 'Middle name',
    'last_name' => 'Last name',
    'email' => 'Email address',
    'dob' => 'Date of birth',
    'gender' => 'Gender',
    'phone' => 'Phone number',
    'address' => 'Address',
    'state_origin' => 'State of origin',
    'local_government' => 'Local government',
    'next_of_kin' => 'Next of kin',
    'jamb_score' => 'JAMB score',
];

$student = [];
$errors = [];

foreach ($required as $field => $label) {
    $value = trim((string) ($_POST[$field] ?? ''));
    $student[$field] = $value;

    if ($value === '') {
        $errors[] = $label . ' is required.';
    }
}

if ($student['email'] !== '' && !filter_var($student['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Enter a valid email address.';
}

if ($student['jamb_score'] !== '' && (!ctype_digit($student['jamb_score']) || (int) $student['jamb_score'] < 0 || (int) $student['jamb_score'] > 400)) {
    $errors[] = 'JAMB score must be a number from 0 to 400.';
}

$image = $_FILES['profile_image'] ?? null;
if (!$image || ($image['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
    $errors[] = 'Profile image is required.';
}

$profileImagePath = '';
if ($image && ($image['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_OK) {
    $allowedTypes = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
        'image/gif' => 'gif',
    ];

    $mime = mime_content_type($image['tmp_name']);
    if (!isset($allowedTypes[$mime])) {
        $errors[] = 'Profile image must be a JPG, PNG, WEBP, or GIF file.';
    } else {
        if (!is_dir(UPLOAD_DIR)) {
            mkdir(UPLOAD_DIR, 0777, true);
        }

        $fileName = uniqid('profile_', true) . '.' . $allowedTypes[$mime];
        $destination = UPLOAD_DIR . '/' . $fileName;

        if (!move_uploaded_file($image['tmp_name'], $destination)) {
            $errors[] = 'Profile image could not be uploaded.';
        } else {
            $profileImagePath = 'uploads/' . $fileName;
        }
    }
}

if ($errors) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $student;
    header('Location: register.php');
    exit;
}

$student['jamb_score'] = (int) $student['jamb_score'];
$student['profile_image'] = $profileImagePath;
$student['admission_status'] = 'Undecided';

try {
    create_student($student);
} catch (PDOException $exception) {
    if ($profileImagePath !== '' && file_exists(__DIR__ . '/' . $profileImagePath)) {
        unlink(__DIR__ . '/' . $profileImagePath);
    }

    $_SESSION['errors'] = ['A student with this email address already exists.'];
    $_SESSION['old'] = $_POST;
    header('Location: register.php');
    exit;
}

header('Location: register.php?created=1');
exit;
