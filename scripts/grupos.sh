#!/bin/bash

while true; do
    clear
    echo "Gestión de Grupos"
    echo "1. Crear Grupo"
    echo "2. Eliminar Grupo"
    echo "3. Modificar Grupo"
    echo "4. Volver atrás"
    read -p "Seleccione una opción (1/2/3/4): " opcion

    case $opcion in
        1)
            clear
            echo "Creando Grupo..."
            ./altaGrupo.sh
            read -p "Presione Enter para continuar..."
            ;;
        2)
            clear
            echo "Eliminando Grupo..."
            ./bajaGrupo.sh
            read -p "Presione Enter para continuar..."
            ;;
        3)
            clear
            echo "Modificando Grupo..."
            ./modificarGrupo.sh
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
