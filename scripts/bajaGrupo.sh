#!/bin/bash

# Solicitar el nombre del grupo a eliminar
read -p "Nombre del grupo a eliminar: " nombre_grupo

# Verificar si el grupo existe
if grep -q "^$nombre_grupo:" /etc/group; then
    # Eliminar el grupo
    groupdel "$nombre_grupo"
    echo "El grupo $nombre_grupo ha sido eliminado con éxito."
else
    echo "El grupo $nombre_grupo no existe."
fi