<?php
require_once __DIR__ . '/data.php';

$filters = [
    'name' => trim((string) ($_GET['name'] ?? '')),
    'admission_status' => trim((string) ($_GET['admission_status'] ?? '')),
    'gender' => trim((string) ($_GET['gender'] ?? '')),
    'jamb_score' => trim((string) ($_GET['jamb_score'] ?? '')),
];

$students = get_students($filters);
$totalStudents = count_students();

page_header('Dashboard');
?>
<main class="page-shell">
    <nav class="topbar compact">
        <a class="brand" href="index.php"><?php echo e(SITE_BRAND); ?></a>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="register.php">Form</a>
            <a href="dashboard.php">Dashboard</a>
        </div>
    </nav>

    <section class="dashboard-head">
        <div>
            <h1>List of student records table</h1>
            <p class="muted"><?php echo count($students); ?> of <?php echo $totalStudents; ?> record(s) shown.</p>
        </div>
        <a class="btn primary" href="register.php">Add Student</a>
    </section>

    <?php if (isset($_GET['created'])): ?>
        <div class="success">Student record submitted successfully.</div>
    <?php endif; ?>

    <form class="filters" method="get">
        <input type="search" name="name" placeholder="Filter by name" value="<?php echo e($filters['name']); ?>">
        <select name="admission_status">
            <option value="">All statuses</option>
            <?php foreach (['Undecided', 'Admitted'] as $status): ?>
                <option value="<?php echo e($status); ?>" <?php echo $filters['admission_status'] === $status ? 'selected' : ''; ?>>
                    <?php echo e($status); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <select name="gender">
            <option value="">All genders</option>
            <?php foreach (['Female', 'Male'] as $gender): ?>
                <option value="<?php echo e($gender); ?>" <?php echo $filters['gender'] === $gender ? 'selected' : ''; ?>>
                    <?php echo e($gender); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="number" name="jamb_score" min="0" max="400" placeholder="JAMB score" value="<?php echo e($filters['jamb_score']); ?>">
        <button class="btn secondary" type="submit">Filter</button>
        <a class="btn ghost" href="dashboard.php">Reset</a>
    </form>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>JAMB score</th>
                    <th>Admission status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!$students): ?>
                    <tr>
                        <td colspan="5" class="empty">No student records found.</td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo e(full_name($student)); ?></td>
                        <td><?php echo e($student['gender'] ?? ''); ?></td>
                        <td><?php echo e((string) ($student['jamb_score'] ?? '')); ?></td>
                        <td>
                            <span class="status <?php echo strtolower((string) ($student['admission_status'] ?? 'undecided')); ?>">
                                <?php echo e($student['admission_status'] ?? 'Undecided'); ?>
                            </span>
                        </td>
                        <td><a class="link-btn" href="view.php?id=<?php echo urlencode((string) ($student['id'] ?? '')); ?>">View</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<?php page_footer(); ?>
