CREATE DATABASE LinkedIn_UTN;
USE	LinkedIn_UTN;
    
#DROP TABLE Careers
CREATE TABLE IF NOT EXISTS Careers
(
	careerId INT AUTO_INCREMENT,
    description VARCHAR(150) NOT NULL,
    active INT,
    
    CONSTRAINT pk_careerId PRIMARY KEY (careerId)
);

SELECT * FROM Careers;
    
#DROP TABLE Students
CREATE TABLE IF NOT EXISTS Students
(
	id_student INT AUTO_INCREMENT NOT NULL,
    id_career INT,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    dni VARCHAR(12) NOT NULL,
    file_number VARCHAR(20) NOT NULL,
    gender VARCHAR(20) NOT NULL,
    birthdate DATETIME NOT NULL,
    email VARCHAR(50) NOT NULL,
    phone_number VARCHAR(25) NOT NULL,
    active INT,
    password VARCHAR(25),
    
    CONSTRAINT pk_id_student PRIMARY KEY (id_student),
    CONSTRAINT fk_id_career FOREIGN KEY (id_career) REFERENCES Career(id_career),
    CONSTRAINT unq_dni UNIQUE (dni),
    CONSTRAINT unq_file_number UNIQUE (file_number),
    CONSTRAINT unq_email UNIQUE (email),
    CONSTRAINT unq_password UNIQUE (password)
);

ALTER TABLE `linkedin_utn`.`students` 
ADD COLUMN `aplication_record` LONGTEXT NULL AFTER `password`;

SELECT * FROM Students;
    
#DROP TABLE JobPositions
CREATE TABLE IF NOT EXISTS JobPositions
(
	jobPositionId INT NOT NULL,
    careerId INT NOT NULL,
    description VARCHAR(50),
    
    CONSTRAINT pk_jobPosition PRIMARY KEY (jobPositionId),
    CONSTRAINT fk_careerId FOREIGN KEY (careerId) REFERENCES Careers(careerId)
);
    
SELECT * FROM JobPositions;

#DROP TABLE JobOffers
CREATE TABLE IF NOT EXISTS JobOffers
(
	jobOfferId INT AUTO_INCREMENT,
	jobPositionId INT,
    id_company INT, 
    title VARCHAR(50) NOT NULL,
    requirements VARCHAR(1000) NOT NULL,
    responsabilities VARCHAR(1000) NOT NULL,
    profits VARCHAR(1000),
    salary INT(11),
    
    CONSTRAINT pk_jobOfferId PRIMARY KEY (jobOfferId),
    CONSTRAINT fk_jobPositionId FOREIGN KEY (jobPositionId) REFERENCES JobPositions(jobPosition),
    CONSTRAINT fk_id_company FOREIGN KEY (id_company) REFERENCES Companies(id_company)
);

INSERT INTO JobOffers(jobPositionId, id_company, title, requirements, responsabilities, profits, salary) 
		VALUES (3, 1, "Desarrollador Java", "Java 8, Springboot, git", "Debera hacerse cargo de un proyecto entero sin documentacion alguna", "Muchos", 0);

#TRUNCATE jobOffers;

SELECT * FROM joboffers;

#DROP TABLE JobOfferXStudent
CREATE TABLE IF NOT EXISTS JobOfferXStudent
(
	jobOfferXStudentId INT AUTO_INCREMENT,
    id_student INT,
    jobOfferId INT,
    
    CONSTRAINT pk_jobOfferXStudentId PRIMARY KEY (jobOfferXStudentId),
    CONSTRAINT fk_id_student FOREIGN KEY (id_student) REFERENCES Students(id_student),
    CONSTRAINT fk_jobOfferId FOREIGN KEY (jobOfferId) REFERENCES JobOffers(jobOfferId)
);

SELECT * FROM JobOfferXStudent;

#DROP TABLE Companies
CREATE TABLE IF NOT EXISTS Companies
(
    id_company INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(50) NOT NULL,
    about_us text,
    company_link VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    industry VARCHAR(50) NOT NULL,
    city VARCHAR(50) NOT NULL,
    country VARCHAR(50) NOT NULL,
    
    CONSTRAINT pk_id_company PRIMARY KEY (id_company),
    CONSTRAINT unq_name UNIQUE (name)
);

SELECT * FROM Companies;

#DROP TABLE Administrators
CREATE TABLE IF NOT EXISTS Administrators
(
    id_admin INT AUTO_INCREMENT NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    
    CONSTRAINT pk_id_admin PRIMARY KEY (id_admin),
    CONSTRAINT unq_email unique (email)
);

SELECT * FROM Administrators;


    
    
