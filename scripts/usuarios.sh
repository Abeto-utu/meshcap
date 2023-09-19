#!/bin/bash

while true; do
    clear
    echo "Administración de Usuarios"
    echo "1. Crear Usuario"
    echo "2. Eliminar Usuario"
    echo "3. Modificar Usuario"
    echo "4. Atras"
    read -p "Seleccione una opción (1/2/3/4): " opcion

    case $opcion in
        1)
            ./altaUsuario.sh
            read -p "Presione Enter para continuar..."
            ;;
        2)
            ./bajaUsuario.sh
            read -p "Presione Enter para continuar..."
            ;;
        3)
            ./modificarUsuario.sh
            read -p "Presione Enter para continuar..."
            ;;
        4)
            exit 0
            ;;
        *)
            echo "Opción no válida. Por favor, seleccione una opción válida (1/2/3/4)."
            read -p "Presione Enter para continuar..."
            ;;
    esac
done