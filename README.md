# MESHCAP
Aplicacion para la gestion de paquetes de la empresa Quick Carry

# INSTALACION

## 1) Clonar el repositorio
Usar el siguiente comando:
git clone https://github.com/Abeto-utu/MeshCap.git

## 2) Iniciar XAMPP
Empezar los servicios de Apache y MySQL

## 3) Iniciar la base de datos
Para crear y usar la base de datos correr las lineas: CREATE DATABASE IF NOT EXISTS meshcap; USE meshcap;

Luego, seleccionar la base de datos meshcap en phpmyadmin y en la seccion de importar seleccionar el archivo sql /MeshCap/mysql/initdb/meshcap.sql

## 4) Iniciar la aplicacion
Mover la carpeta "src/" hacia "C:\xampp\htdocs". Luego, en un navegador ingresar a localhost/src/VISTA
