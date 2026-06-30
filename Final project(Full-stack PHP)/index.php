<?php
require_once __DIR__ . '/data.php';

page_header('Welcome');
?>
<main class="hero">
    <nav class="topbar">
        <a class="brand" href="index.php"><?php echo e(SITE_BRAND); ?></a>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="register.php">Register</a>
            <a href="dashboard.php">Dashboard</a>
        </div>
    </nav>

    <section class="hero-content">
        <div class="hero-copy">
            <h1><?php echo e(SITE_BRAND); ?> Student Portal</h1>
            <p>Register new students quickly and securely. Start your admissions process with <?php echo e(SITE_BRAND); ?> today.</p>
            <div class="hero-actions">
                <a class="btn primary" href="register.php">Get Started</a>
            </div>
        </div>
        <div class="hero-illustration" aria-hidden="true">
            <div class="board left-board">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="board right-board">
                <span></span>
            </div>
            <div class="student one"></div>
            <div class="student two"></div>
            <div class="teacher"></div>
        </div>
    </section>

    <footer class="site-footer">© <?php echo e(SITE_BRAND); ?> 2026. All rights reserved.</footer>
</main>
<?php page_footer(); ?>
