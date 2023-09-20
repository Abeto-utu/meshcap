# MESHCAP
Aplicacion para la gestion de paquetes de la empresa Quick Carry

# INSTALACION

## 1) Clonar el repositorio
Usar el siguiente comando:
git clone https://github.com/Abeto-utu/MeshCap.git

## 2) Iniciar XAMPP
Empezar los servicios de Apache y MySQL

## 3) Iniciar la base de datos
Para crear y usar la base de datos correras las lineas: CREATE DATABASE IF NOT EXISTS meshcap; USE meshcap;

Luego, en la seccion de phpmyadmin importar el archivo sql /MeshCap/mysql/initdb/meshcap.sql

## 4) Iniciar la aplicacion
En una terminal en la carpeta /src correr el comando: "php -S localhost:8080". Luego, en un navegador ingresar a localhost:8080
