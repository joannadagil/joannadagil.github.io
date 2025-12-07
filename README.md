# joannadagil.github.io





## lab01 - 10.10
Pusta stronka html na jakimś serwerze. Z kodowaniem polskich znaków.

## lab02 - 17.10
Stronka z kolumnami w różnych ilościach, galerią zdjęć.

## lab03 - 21.10


## lab04 - 3.11
Kalkulator w javascript z walidacją wpisywanych zapytań. Obsługiwanie *, /, +, -, ., = oraz C-wyczyść.

## lab05 - 10.11
XML - wypełnianie bloczka faktury (nazwa, ilość, kwota, suma) i w pętli dodawanie kolejnych faktur i sumowanie ich.

## lab06 - 17.11
Strona, kna którą za pomocą XLT będzie wyświetlany plik XML. Plik XML ma być gotowy już wcześniej, ma zawierać fakturę i dane do niej między dowolnymi znacznikami. Można dodać też Scheme, żeby była walidacja. 

Druga opcja to zrobić formularz, który będzie zapisywał dane do XML i potem na podstronie wczytywał z tego XML przy użyciu XSL dane tej faktury.

## lab07 - 24.11
Korzystając ze strony z formularzem, używająć PHP, wyświetlić wprowadzone na niej dane na kolejnej podstronie

XAMPP Control Panel -> Apache -> Start
                    -> MySQL  -> Start

http://localhost/joannadagil.github.io/

## lab08 - 01.12
Wyświetlanie tabeli z bazy danych z danymi użytkownika. Obsługiwanie dodawania nowych użytkowników, edycji istniejących i usuwania ich.

### setup bazy danych

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

## lab09 - 08.12

### setup bazy danych

mysql -u root -p

USE users_db;

CREATE TABLE auth_users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255)
);

INSERT INTO auth_users (username, password)
VALUES ('root', PASSWORD('root'));



