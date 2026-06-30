<?php
declare(strict_types=1);

require_once __DIR__ . '/data.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: dashboard.php');
    exit;
}

$id = (int) ($_POST['student_id'] ?? 0);
$status = isset($_POST['admitted']) ? 'Admitted' : 'Undecided';

if ($id > 0) {
    update_admission_status($id, $status);
}

header('Location: view.php?id=' . $id . '&updated=1');
exit;
