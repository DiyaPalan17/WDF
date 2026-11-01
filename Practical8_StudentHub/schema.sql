-- Optional schema for the existing student database.
-- Does not drop or delete any existing tables.
CREATE TABLE IF NOT EXISTS stu_data (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    NAME VARCHAR(100) NOT NULL,
    EMAIL VARCHAR(150) NOT NULL,
    GENDER VARCHAR(20) NOT NULL,
    `PHONE NO.` VARCHAR(20) NOT NULL,
    ADDRESS VARCHAR(255) NOT NULL,
    PINCODE VARCHAR(12) NOT NULL,
    MESSAGE TEXT
);

-- Optional example row. Uncomment and run only if you want sample data.
-- INSERT INTO stu_data (NAME, EMAIL, GENDER, `PHONE NO.`, ADDRESS, PINCODE, MESSAGE)
-- VALUES ('Sample Student', 'sample@example.com', 'Female', '9876543210', 'Sample Address', '360001', 'Practical 8 test record');
