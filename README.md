# MESHCAP
Aplicacion para la gestion de paquetes de la empresa Quick Carry

# Instalacion

## Clonar el repositorio
Usar el siguiente comando:
git clone https://github.com/Abeto-utu/MeshCap.git

## Iniciar XAMPP
Empezar los servicios de Apache y MySQL

## Iniciar la base de datos
Correr estas dos lineas de mysql para crear y usar la base de datos
CREATE DATABASE IF NOT EXISTS meshcap;
USE meshcap;
Luego, en la seccion de phpmyadmin importar el archivo sql /MeshCap/mysql/initdb/meshcap.sql

## Iniciar la aplicacion
En una terminal en la carpeta /src correr este comando
php -S localhost:8080
Luego, en un navegador ingresar a localhost:8080
