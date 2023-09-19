#!/bin/bash

# Solicitar el nombre del grupo a crear
read -p "Nombre del grupo a crear: " nombre_grupo

# Verificar si el grupo ya existe
if grep -q "^$nombre_grupo:" /etc/group; then
    echo "El grupo $nombre_grupo ya existe."
else
    # Crear el grupo
    groupadd "$nombre_grupo"
    echo "El grupo $nombre_grupo ha sido creado con éxito."
fi