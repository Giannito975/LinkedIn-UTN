CREATE DATABASE LinkedIn_UTN;
USE	LinkedIn_UTN;
    
#DROP TABLE Career
CREATE TABLE IF NOT EXISTS Careers
(
	id_career INT AUTO_INCREMENT,
    description VARCHAR(150) NOT NULL,
    active BOOLEAN,
    
    CONSTRAINT pk_id_career PRIMARY KEY (id_career)
);
    
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
    email VARCHAR(30),
    phone_number VARCHAR(25) NOT NULL,
    active BOOLEAN,
    
    CONSTRAINT pk_id_student PRIMARY KEY (id_student),
    CONSTRAINT fk_id_career FOREIGN KEY (id_career) REFERENCES Career(id_career),
    CONSTRAINT unq_dni UNIQUE (dni),
    CONSTRAINT unq_file_number UNIQUE (file_number),
    CONSTRAINT unq_email UNIQUE (email)
);

SELECT * FROM Students;
    
CREATE TABLE IF NOT EXISTS Companies
(
    id_company INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(50) NOT NULL,
    foundation_date date NOT NULL,
    cuit char(11) NOT NULL,
    aboutUs text,
    company_link VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    active boolean NOT NULL,
    industry INT NOT NULL,
    city INT NOT NULL,
    country INT NOT NULL,
    creation_admin INT NOT NULL,
    
    CONSTRAINT pk_id_company PRIMARY KEY (id_company),
    CONSTRAINT unq_cuit unique (cuit),
    CONSTRAINT fk_industry foreign key (industry) references industries (id),
    CONSTRAINT fk_city foreign key (city) references cities (id),
    CONSTRAINT fk_country foreign key (country) references countries (id),
    CONSTRAINT fk_creation_admin foreign key (creation_admin) references administrators (id_admin)
);
    
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

CREATE TABLE IF NOT EXISTS Administrators
(
    id_admin INT AUTO_INCREMENT NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    employee_number VARCHAR(20) NOT NULL,
    
    CONSTRAINT pk_id_admin PRIMARY KEY (id_admin),
    CONSTRAINT unq_employee_number unique (employee_number)
);


    
    
