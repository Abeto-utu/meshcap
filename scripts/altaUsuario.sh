#!/bin/bash

# Solicitar nombre de usuario y grupo
read -p "Nombre de usuario: " usuario
read -p "Grupo (default, administradores, gestion): " grupo

# Definir el directorio de inicio predeterminado
dir_home="/home/$usuario"

# Definir grupo predeterminado
grupo_primario="group0"

# Crear usuario segun su grupo
if [[ "$grupo" == "default" ]]; then
    useradd -m -d "$dir_home" -g "$grupo_primario" -s /bin/bash "$usuario"
elif [[ "$grupo" == "administradores" ]]; then
    useradd -m -d "$dir_home" -g "$grupo_primario" -G "$grupo_primario,group1" -s /bin/bash "$usuario"
elif [[ "$grupo" == "gestion" ]]; then
    useradd -m -d "$dir_home" -g "$grupo_primario" -G "$grupo_primario,group2" -s /bin/bash "$usuario"
else
    useradd -m -d "$dir_home" -g "$grupo_primario" -s /bin/bash "$usuario"
fi

# Mostrar información del usuario creado
echo "Usuario $usuario creado con directorio de inicio $dir_home y perteneciendo a los grupos: $grupo_primario $otros_grupos"
