#!/bin/bash

# Solicitar el nombre del grupo a modificar
read -p "Nombre del grupo a modificar: " nombre_grupo_actual

# Verificar si el grupo existe
if grep -q "^$nombre_grupo_actual:" /etc/group; then
    # Solicitar el nuevo nombre para el grupo
    read -p "Nuevo nombre para el grupo: " nuevo_nombre_grupo

    # Verificar si el nuevo nombre ya existe
    if grep -q "^$nuevo_nombre_grupo:" /etc/group; then
        echo "El nuevo nombre para el grupo ya existe."
    else
        # Modificar el nombre del grupo
        groupmod -n "$nuevo_nombre_grupo" "$nombre_grupo_actual"
        echo "El nombre del grupo $nombre_grupo_actual ha sido cambiado a $nuevo_nombre_grupo con éxito."
    fi
else
    echo "El grupo $nombre_grupo_actual no existe."
fi