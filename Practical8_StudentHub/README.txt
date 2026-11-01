PRACTICAL 8 - STUDENTHUB DATABASE TEST

Files:
- db.php: PDO connection to database "student"
- student.php: displays records from existing "stu_data" table
- Test_connection.php: PDO connection and table-output test page
- schema.sql: optional table schema; it does not delete existing tables

SETUP:
1. Start Apache and MySQL in XAMPP.
2. Copy these files into C:\xampp\htdocs\pr_8\pr_8\
   Keep existing process.php, cont.php, and other project files if needed.
3. In phpMyAdmin, confirm database "student" contains table "stu_data".
4. Open:
   http://localhost/pr_8/pr_8/student.php
   or
   http://localhost/pr_8/pr_8/Test_connection.php

NOTES:
- Uses PDO for these two database display/test pages.
- Assumes XAMPP MySQL username root and an empty password. If yours differs, update db.php.
- Empty tables show a message instead of failing.
- This package targets your existing stu_data table. Your earlier checklist mentioned students/events/registrations in 3NF; if your instructor requires those three separate tables, this schema needs to be expanded.
