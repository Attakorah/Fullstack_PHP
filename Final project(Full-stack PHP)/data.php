<?php
declare(strict_types=1);

const DB_DIR = __DIR__ . '/database';
const DB_FILE = DB_DIR . '/student_portal.sqlite';
const STATES_FILE = __DIR__ . '/states-localgovts.json';
const UPLOAD_DIR = __DIR__ . '/uploads';
const SITE_BRAND = 'Startocode';

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function db(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    if (!is_dir(DB_DIR)) {
        mkdir(DB_DIR, 0777, true);
    }

    if (!is_dir(UPLOAD_DIR)) {
        mkdir(UPLOAD_DIR, 0777, true);
    }

    $pdo = new PDO('sqlite:' . DB_FILE);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS students (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            profile_image TEXT NOT NULL,
            first_name TEXT NOT NULL,
            middle_name TEXT NOT NULL,
            last_name TEXT NOT NULL,
            email TEXT NOT NULL UNIQUE,
            dob TEXT NOT NULL,
            gender TEXT NOT NULL,
            phone TEXT NOT NULL,
            address TEXT NOT NULL,
            state_origin TEXT NOT NULL,
            local_government TEXT NOT NULL,
            next_of_kin TEXT NOT NULL,
            jamb_score INTEGER NOT NULL,
            admission_status TEXT NOT NULL DEFAULT "Undecided",
            created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
        )'
    );

    return $pdo;
}

function create_student(array $student): int
{
    $pdo = db();
    $statement = $pdo->prepare(
        'INSERT INTO students (
            profile_image, first_name, middle_name, last_name, email, dob, gender, phone,
            address, state_origin, local_government, next_of_kin, jamb_score, admission_status
        ) VALUES (
            :profile_image, :first_name, :middle_name, :last_name, :email, :dob, :gender, :phone,
            :address, :state_origin, :local_government, :next_of_kin, :jamb_score, :admission_status
        )'
    );

    $statement->execute($student);

    return (int) $pdo->lastInsertId();
}

function get_students(array $filters = []): array
{
    $sql = 'SELECT * FROM students WHERE 1 = 1';
    $params = [];

    if (($filters['name'] ?? '') !== '') {
        $sql .= ' AND (first_name LIKE :name OR middle_name LIKE :name OR last_name LIKE :name)';
        $params['name'] = '%' . $filters['name'] . '%';
    }

    if (($filters['admission_status'] ?? '') !== '') {
        $sql .= ' AND admission_status = :admission_status';
        $params['admission_status'] = $filters['admission_status'];
    }

    if (($filters['gender'] ?? '') !== '') {
        $sql .= ' AND gender = :gender';
        $params['gender'] = $filters['gender'];
    }

    if (($filters['jamb_score'] ?? '') !== '') {
        $sql .= ' AND jamb_score = :jamb_score';
        $params['jamb_score'] = (int) $filters['jamb_score'];
    }

    $sql .= ' ORDER BY created_at DESC, id DESC';
    $statement = db()->prepare($sql);
    $statement->execute($params);

    return $statement->fetchAll();
}

function count_students(): int
{
    return (int) db()->query('SELECT COUNT(*) FROM students')->fetchColumn();
}

function find_student(int $id): ?array
{
    $statement = db()->prepare('SELECT * FROM students WHERE id = :id');
    $statement->execute(['id' => $id]);
    $student = $statement->fetch();

    return $student ?: null;
}

function update_admission_status(int $id, string $status): void
{
    $statement = db()->prepare('UPDATE students SET admission_status = :status WHERE id = :id');
    $statement->execute([
        'id' => $id,
        'status' => $status,
    ]);
}

function read_states(): array
{
    if (!file_exists(STATES_FILE)) {
        return [];
    }

    $json = file_get_contents(STATES_FILE);
    $data = json_decode($json ?: '{}', true);

    return $data['states'] ?? [];
}

function full_name(array $student): string
{
    return trim(($student['first_name'] ?? '') . ' ' . ($student['middle_name'] ?? '') . ' ' . ($student['last_name'] ?? ''));
}

function page_header(string $title): void
{
    db();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo e($title); ?> | <?php echo e(SITE_BRAND); ?></title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <?php
}

function page_footer(): void
{
    ?>
    </body>
    </html>
    <?php
}
