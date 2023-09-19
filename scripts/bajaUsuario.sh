#!/bin/bash

# Solicitar nombre de usuario a eliminar
read -p "Nombre de usuario a eliminar: " usuario

# Verificar si el usuario existe
if id "$usuario" &>/dev/null; then
    # Eliminar el usuario y su directorio de inicio
    userdel -r "$usuario"
    
    echo "El usuario $usuario ha sido eliminado junto con su directorio de inicio."
else
    echo "El usuario $usuario no existe."
fi