#!/bin/bash

# Solicitar el nombre del usuario a modificar
read -p "Nombre de usuario a modificar: " usuario

# Verificar si el usuario existe
if id "$usuario" &>/dev/null; then
    # Solicitar las nuevas configuraciones
    read -p "Nuevo nombre de usuario (dejar en blanco para mantener el actual): " nuevo_usuario
    read -p "Nuevo grupo principal (dejar en blanco para mantener el actual): " nuevo_grupo_primario
    read -p "Nuevos grupos adicionales (separados por comas, dejar en blanco para mantener los actuales): " nuevos_grupos_adicionales

    # Comprobar si se proporcionaron valores nuevos y modificar el usuario
    if [ -n "$nuevo_usuario" ]; then
        usermod -l "$nuevo_usuario" "$usuario"
    fi

    if [ -n "$nuevo_grupo_primario" ]; then
        usermod -g "$nuevo_grupo_primario" "$usuario"
    fi

    if [ -n "$nuevos_grupos_adicionales" ]; then
        IFS=',' read -ra grupos <<< "$nuevos_grupos_adicionales"
        for grupo in "${grupos[@]}"; do
            usermod -aG "$grupo" "$usuario"
        done
    fi

    echo "El usuario $usuario ha sido modificado con éxito."
else
    echo "El usuario $usuario no existe."
fi