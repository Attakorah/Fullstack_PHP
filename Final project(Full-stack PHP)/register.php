<?php
session_start();
require_once __DIR__ . '/data.php';

$states = read_states();
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
$created = isset($_GET['created']);

page_header('Registration');
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

    <section class="form-layout">
        <h1 class="page-title"><?php echo e(SITE_BRAND); ?> Registration</h1>

        <?php if ($created): ?>
            <div class="success">
                Student record submitted successfully. You can view it on the dashboard.
            </div>
        <?php endif; ?>

        <?php if ($errors): ?>
            <div class="alert">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo e($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form class="portal-form" action="process.php" method="post" enctype="multipart/form-data">
            <h2 class="form-section-title">Personal Information</h2>
            <label>
                Profile image
                <input type="file" name="profile_image" accept="image/png,image/jpeg,image/webp,image/gif" required>
            </label>

            <div class="grid three">
                <label>
                    First name
                    <input type="text" name="first_name" value="<?php echo e($old['first_name'] ?? ''); ?>" required>
                </label>
                <label>
                    Middle name
                    <input type="text" name="middle_name" value="<?php echo e($old['middle_name'] ?? ''); ?>" required>
                </label>
                <label>
                    Last name
                    <input type="text" name="last_name" value="<?php echo e($old['last_name'] ?? ''); ?>" required>
                </label>
            </div>

            <div class="grid three">
                <label>
                    Email address
                    <input type="email" name="email" value="<?php echo e($old['email'] ?? ''); ?>" required>
                </label>
                <label>
                    Date of birth
                    <input type="date" name="dob" value="<?php echo e($old['dob'] ?? ''); ?>" required>
                </label>
                <label>
                    Gender
                    <select name="gender" required>
                        <option value="">Select gender</option>
                        <?php foreach (['Female', 'Male'] as $gender): ?>
                            <option value="<?php echo e($gender); ?>" <?php echo (($old['gender'] ?? '') === $gender) ? 'selected' : ''; ?>>
                                <?php echo e($gender); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>

            <div class="grid two">
                <label>
                    Phone number
                    <input type="tel" name="phone" value="<?php echo e($old['phone'] ?? ''); ?>" required>
                </label>
                <label>
                    JAMB score
                    <input type="number" name="jamb_score" min="0" max="400" value="<?php echo e($old['jamb_score'] ?? ''); ?>" required>
                </label>
            </div>

            <div class="grid two">
                <label>
                    State of origin
                    <select name="state_origin" id="state_origin" required>
                        <option value="">Select state</option>
                        <?php foreach ($states as $state): ?>
                            <?php $stateName = $state['state'] ?? ''; ?>
                            <option value="<?php echo e($stateName); ?>" <?php echo (($old['state_origin'] ?? '') === $stateName) ? 'selected' : ''; ?>>
                                <?php echo e($stateName); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label>
                    Local government
                    <select name="local_government" id="local_government" required>
                        <option value="">Select local government</option>
                    </select>
                </label>
            </div>

            <h2 class="form-section-title">Admission Related Information</h2>
            <div class="grid two">
                <label>
                    Next of kin
                    <input type="text" name="next_of_kin" value="<?php echo e($old['next_of_kin'] ?? ''); ?>" required>
                </label>
                <label>
                    Address
                    <textarea name="address" rows="4" required><?php echo e($old['address'] ?? ''); ?></textarea>
                </label>
            </div>

            <button class="btn primary" type="submit">Submit Record</button>
        </form>
    </section>
</main>

<script>
const stateData = <?php echo json_encode($states); ?>;
const stateSelect = document.querySelector('#state_origin');
const localSelect = document.querySelector('#local_government');
const selectedLocal = <?php echo json_encode($old['local_government'] ?? ''); ?>;

function loadLocals() {
    const selected = stateData.find((item) => item.state === stateSelect.value);
    localSelect.innerHTML = '<option value="">Select local government</option>';

    if (!selected) {
        return;
    }

    selected.local.forEach((local) => {
        const option = document.createElement('option');
        option.value = local;
        option.textContent = local;
        option.selected = local === selectedLocal;
        localSelect.appendChild(option);
    });
}

stateSelect.addEventListener('change', loadLocals);
loadLocals();
</script>
<?php page_footer(); ?>
