#!/bin/bash

while true; do
    clear
    echo "Gestión de Logs"
    echo "1. Mostrar usuarios conectados (who)"
    echo "2. Mostrar información sobre usuarios (w)"
    echo "3. Mostrar último inicio de sesión (last)"
    echo "4. Mostrar registro de inicios de sesión (lastlog)"
    echo "5. Mostrar registro de inicios de sesión fallidos (lastb)"
    echo "6. Volver atrás"
    read -p "Seleccione una opción (1/2/3/4/5/6): " opcion

    case $opcion in
        1)
            clear
            echo "Mostrando usuarios conectados (who)..."
            who
            read -p "Presione Enter para continuar..."
            ;;
        2)
            clear
            echo "Mostrando información sobre usuarios (w)..."
            w
            read -p "Presione Enter para continuar..."
            ;;
        3)
            clear
            echo "Mostrando último inicio de sesión (last)..."
            last
            read -p "Presione Enter para continuar..."
            ;;
        4)
            clear
            echo "Mostrando registro de inicios de sesión (lastlog)..."
            lastlog
            read -p "Presione Enter para continuar..."
            ;;
        5)
            clear
            echo "Mostrando registro de inicios de sesión fallidos (lastb)..."
            lastb
            read -p "Presione Enter para continuar..."
            ;;
        6)
            exit 0
            ;;
        *)
            echo "Opción no válida. Por favor, seleccione una opción válida (1/2/3/4/5/6)."
            read -p "Presione Enter para continuar..."
            ;;
    esac
done