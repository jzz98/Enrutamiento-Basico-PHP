CREATE DATABASE Routing;
USE Routing;

CREATE TABLE Users(
	ID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(30),
    Contraseña VARCHAR(30)
);

SELECT * FROM Users;