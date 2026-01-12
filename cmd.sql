CREATE TABLE hussier(
    id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(150) NOT NULL,
	email VARCHAR(250) NOT NULL UNIQUE,
	phone VARCHAR(30) NOT NULL UNIQUE,
    years_of_experiences int,
    hourly_rate  DECIMAL(10, 2) ,
    type ENUM('Signification', 'Exécution', 'Constats'),
    city_id INT,
    FOREIGN KEY (city_id) REFERENCES city(id)
    );

CREATE TABLE lawyer(
id INT PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(150) NOT NULL,
email VARCHAR(250) NOT NULL UNIQUE,
phone VARCHAR(30) NOT NULL UNIQUE,
years_of_experiences INT,
hourly_rate DECIMAL (10,2),
specialization ENUM('Droit pénal', 'Civil', 'Famille', 'Affaires') NOT NULL,
consultation_online bool,
city_id INT,
FOREIGN KEY (city_id) REFERENCES city(id)
);

CREATE TABLE city(
id INT PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(150) NOT NULL
);