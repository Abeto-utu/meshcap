#!/bin/bash

#Crear un directorio con la fecha actual para almacenar el backup
d=$(date +%Y-%m-%d_%H:%M:%S)
mkdir /home/meshcap/backups/$d

#Hacer el backup de la base de datos meshcap en el contenedor base-de-datos
docker exec base-de-datos mysqldump --no-tablespaces meshcap > out.sql

#Comprimir el backup, moverlo al directorio con la fecha actual y borrar el backup sin comprimir
tar -czvf backup.tar.gz /home/meshcap/out.sql
rm -r -f out.sql
mv backup.tar.gz /home/meshcap/backups/$d

cd /home/meshcap/