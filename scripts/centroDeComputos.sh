#!/bin/bash

while true; do
    clear
    echo "Menú Principal"
    echo "1. Gestionar Usuarios"
    echo "2. Gestionar Grupos"
    echo "3. Realizar Backup Manual"
    echo "4. Gestionar Logs"
    echo "5. Gestionar Procesos"
    echo "6. Gestionar Servicios"
    echo "7. Gestionar Red"
    echo "8. Salir"
    read -p "Seleccione una opción (1/2/3/4/5/6/7/8): " opcion

    case $opcion in
        1)
            clear
            echo "Gestión de Usuarios"
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
            clear
            echo "Gestión de Procesos"
            ./procesos.sh
            read -p "Presione Enter para continuar..."
            ;;
        6)
            clear
            echo "Gestión de Servicios"
            ./servicios.sh
            read -p "Presione Enter para continuar..."
            ;;
        7)
            clear
            echo "Gestión de Red"
            ./redes.sh
            read -p "Presione Enter para continuar..."
            ;;
        8)
            exit 0
            ;;
        *)
            echo "Opción no válida. Por favor, seleccione una opción válida (1/2/3/4/5/6/7/8)."
            read -p "Presione Enter para continuar..."
            ;;
    esac
done
