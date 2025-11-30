# joannadagil.github.io

XAMPP Control Panel -> Apache -> Start
                    -> MySQL  -> Start

http://localhost/joannadagil.github.io/




## setup bazy danych

mysql -u root -p

CREATE DATABASE users_db;

USE users_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    imie VARCHAR(50),
    nazwisko VARCHAR(50),
    pesel VARCHAR(11),
    data_urodzenia DATE
);
