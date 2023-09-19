#!/bin/bash

while true; do
    clear
    echo "Menú Principal"
    echo "1. Gestionar Usuarios"
    echo "2. Gestionar Grupos"
    echo "3. Realizar Backup Manual"
    echo "4. Gestionar Logs"
    echo "5. Salir"
    read -p "Seleccione una opción (1/2/3/4/5): " opcion

    case $opcion in
        1)
            clear
            ./usuarios.sh
            read -p "Presione Enter para continuar..."
            ;;
        2)
            clear
            echo "Gestión de Grupos"
            ./grupos.sh
            read -p "Presione Enter para continuar..."
            ;;
        3)
            clear
            echo "Realizando Backup Manual"
            ./backup.sh
            read -p "Presione Enter para continuar..."
            ;;
        4)
            clear
            echo "Gestión de Logs"
            ./logs.sh
            read -p "Presione Enter para continuar..."
            ;;
        5)
            exit 0
            ;;
        *)
            echo "Opción no válida. Por favor, seleccione una opción válida (1/2/3/4/5)."
            read -p "Presione Enter para continuar..."
            ;;
    esac
done