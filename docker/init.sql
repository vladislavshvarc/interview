CREATE DATABASE interview CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE DATABASE interview_test CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE USER 'interview'@'%' IDENTIFIED BY 'password';

GRANT ALL PRIVILEGES ON interview.* TO 'interview'@'%';

GRANT ALL PRIVILEGES ON interview_test.* TO 'interview'@'%';

FLUSH PRIVILEGES;
