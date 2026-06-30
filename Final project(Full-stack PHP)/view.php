<?php
require_once __DIR__ . '/data.php';

$student = find_student((int) ($_GET['id'] ?? 0));

page_header('Student Details');
?>
<main class="page-shell">
    <nav class="topbar compact">
        <a class="brand" href="index.php"><?php echo e(SITE_BRAND); ?></a>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="dashboard.php">Dashboard</a>
            <a href="register.php">Form</a>
        </div>
    </nav>

    <?php if (!$student): ?>
        <section class="details-card">
            <p class="eyebrow">Record not found</p>
            <h1>Student record unavailable</h1>
            <p class="muted">The selected student record does not exist.</p>
            <a class="btn primary" href="dashboard.php">Back to Dashboard</a>
        </section>
    <?php else: ?>
        <section class="profile-panel">
            <div class="profile-summary">
                <img class="profile-photo" src="<?php echo e($student['profile_image']); ?>" alt="<?php echo e(full_name($student)); ?>">
                <div>
                    <h2 class="info-title">Personal Information</h2>
                    <h1><?php echo e(full_name($student)); ?></h1>
                    <p class="muted">Registered on <?php echo e($student['created_at'] ?? ''); ?></p>
                    <span class="status <?php echo strtolower((string) ($student['admission_status'] ?? 'undecided')); ?>">
                        <?php echo e($student['admission_status'] ?? 'Undecided'); ?>
                    </span>
                </div>
            </div>

            <?php if (isset($_GET['updated'])): ?>
                <div class="success">Admission status updated successfully.</div>
            <?php endif; ?>

            <form class="status-form" action="update_status.php" method="post">
                <input type="hidden" name="student_id" value="<?php echo e((string) $student['id']); ?>">
                <label class="check-row">
                    <input type="checkbox" name="admitted" value="1" <?php echo ($student['admission_status'] ?? '') === 'Admitted' ? 'checked' : ''; ?>>
                    Mark this student as admitted
                </label>
                <button class="btn primary" type="submit">Save Status</button>
                <a class="btn secondary" href="dashboard.php">Back to Dashboard</a>
            </form>

            <dl class="details-grid">
                <div><dt>First name</dt><dd><?php echo e($student['first_name'] ?? ''); ?></dd></div>
                <div><dt>Middle name</dt><dd><?php echo e($student['middle_name'] ?? ''); ?></dd></div>
                <div><dt>Last name</dt><dd><?php echo e($student['last_name'] ?? ''); ?></dd></div>
                <div><dt>Email</dt><dd><?php echo e($student['email'] ?? ''); ?></dd></div>
                <div><dt>Date of birth</dt><dd><?php echo e($student['dob'] ?? ''); ?></dd></div>
                <div><dt>Gender</dt><dd><?php echo e($student['gender'] ?? ''); ?></dd></div>
                <div><dt>Phone number</dt><dd><?php echo e($student['phone'] ?? ''); ?></dd></div>
                <div><dt>JAMB score</dt><dd><?php echo e((string) ($student['jamb_score'] ?? '')); ?></dd></div>
                <div><dt>State of origin</dt><dd><?php echo e($student['state_origin'] ?? ''); ?></dd></div>
                <div><dt>Local government</dt><dd><?php echo e($student['local_government'] ?? ''); ?></dd></div>
                <div><dt>Next of kin</dt><dd><?php echo e($student['next_of_kin'] ?? ''); ?></dd></div>
                <div><dt>Admission status</dt><dd><?php echo e($student['admission_status'] ?? 'Undecided'); ?></dd></div>
                <div class="wide"><dt>Address</dt><dd><?php echo nl2br(e($student['address'] ?? '')); ?></dd></div>
            </dl>
        </section>
    <?php endif; ?>
</main>
<?php page_footer(); ?>
