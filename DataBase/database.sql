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

SELECT * FROM Students;
    
#DROP TABLE JobPosition
CREATE TABLE IF NOT EXISTS JobPosition
(
	jobPositionId INT NOT NULL,
    careerId INT NOT NULL,
    companiesId INT NOT NULL,
    description VARCHAR(50),
    
    CONSTRAINT pk_jobPosition PRIMARY KEY (jobPositionId),
    CONSTRAINT fk_careerId FOREIGN KEY (careerId) REFERENCES Careers(careerId),
    CONSTRAINT fk_companiesId FOREIGN KEY (companiesId) REFERENCES Companies (id_company)
);
    
SELECT * FROM JobPosition;

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
    CONSTRAINT fk_industry foreign key (industry) references industries (id),
    CONSTRAINT fk_city foreign key (city) references cities (id),
    CONSTRAINT fk_country foreign key (country) references countries (id)
);

SELECT * FROM Companies;
    
CREATE TABLE IF NOT EXISTS Cities
(
    id_city INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(50) NOT NULL,
    
    CONSTRAINT pk_id_city PRIMARY KEY (id_city),
    CONSTRAINT unq_city unique (name)
);

CREATE TABLE IF NOT EXISTS Countries
(
    id_coountry INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(50) NOT NULL,
    
    CONSTRAINT pk_id_country PRIMARY KEY (id_country),
    CONSTRAINT unq_country unique (name)
);

CREATE TABLE IF NOT EXISTS Industries
(
    id_industry INT AUTO_INCREMENT NOT NULL,
    type VARCHAR(50) NOT NULL,
    
    CONSTRAINT pk_id_industry PRIMARY KEY (id_industry),
    CONSTRAINT unq_industry unique (type)
);

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


    
    
