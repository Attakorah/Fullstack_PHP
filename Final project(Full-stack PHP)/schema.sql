CREATE TABLE IF NOT EXISTS students (
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
    admission_status TEXT NOT NULL DEFAULT 'Undecided',
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
);
