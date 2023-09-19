#!/bin/bash

# Solicitar nombre de usuario y grupo
read -p "Nombre de usuario: " usuario
read -p "Grupo (default, administradores, gestion): " grupo

# Definir el directorio de inicio predeterminado
dir_home="/home/$usuario"

# Definir grupos predeterminados
grupo_primario="group0"
otros_grupos=""

# Asignar grupos adicionales según la elección del grupo
if [[ "$grupo" == "default" ]]; then
    :
elif [[ "$grupo" == "administradores" ]]; then
    otros_grupos="group1"
elif [[ "$grupo" == "gestion" ]]; then
    otros_grupos="group2"
else
    echo "Grupo no válido, se asignará el grupo predeterminado."
fi

# Crear el usuario
useradd -m -d "$dir_home" -g "$grupo_primario" -G "$grupo_primario,$otros_grupos" -s /bin/bash "$usuario"

# Establecer la contraseña del usuario
passwd "$usuario"

# Mostrar información del usuario creado
echo "Usuario $usuario creado con directorio de inicio $dir_home y perteneciendo a los grupos: $grupo_primario $otros_grupos"
read -p "Presione Enter para continuar..."