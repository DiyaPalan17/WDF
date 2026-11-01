# StudentHub Portal — Practical 15 starter project

This is a standalone, runnable PHP/MySQL project package for Practical 15. It includes registration, login/logout, a student dashboard, profile display, campus events, AJAX event search, contact form, and feedback form.

## Requirements
- XAMPP (Apache, PHP, MySQL)
- A modern browser

## Run locally
1. Extract this folder into `C:\\xampp\\htdocs\\StudentHub_Practical15_Code`.
2. Start Apache and MySQL in XAMPP.
3. Open `http://localhost/phpmyadmin`.
4. Import `database.sql` (it creates the `studenthub` database and sample events).
5. Check database settings in `includes/bootstrap.php`. Default XAMPP settings are user `root`, blank password.
6. Open `http://localhost/StudentHub_Practical15_Code/`.
7. Register a student account and test login, dashboard, profile, events search, contact form, feedback form, and logout.

## Security notes
Passwords are hashed; database operations use prepared statements; form submissions use CSRF tokens; output is escaped. This is a classroom starter. Review and test it before submitting, and adapt it to your instructor's required existing practical modules.

## GitHub submission
Create a repository and upload the project files. Do not upload real passwords, production credentials, or private data.

## Deliverables
- Source code
- `database.sql` (database schema and sample event rows)
- `TEST_REPORT.md` (complete it after testing)
- Screenshots/demo (capture your own working application)
