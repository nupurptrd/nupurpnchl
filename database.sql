CREATE DATABASE examportal;

USE examportal;

CREATE TABLE students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  centre VARCHAR(100) NOT NULL,
  role VARCHAR(100) NOT NULL
);
INSERT INTO students (name, email, password, centre, role)
VALUES ('student', 'student123@gmail.com', MD5('student123'), 'Ahmedabad', 'student');

CREATE TABLE exams (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100) NOT NULL,
  description TEXT,
  date DATE NOT NULL
);
ALTER TABLE exams ADD duration INT DEFAULT 30;


CREATE TABLE results (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT,
  exam_id INT,
  score INT,
  FOREIGN KEY (student_id) REFERENCES students(id),
  FOREIGN KEY (exam_id) REFERENCES exams(id)
);
ALTER TABLE results ADD UNIQUE(student_id, exam_id);


CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL
);

INSERT INTO admins (username, password)
VALUES ('admin', MD5('admin123')); 

CREATE TABLE questions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  exam_id INT,
  question TEXT NOT NULL,
  option_a VARCHAR(255),
  option_b VARCHAR(255),
  option_c VARCHAR(255),
  option_d VARCHAR(255),
  correct_option CHAR(1),
  FOREIGN KEY (exam_id) REFERENCES exams(id)
);
