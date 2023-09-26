#!/bin/bash

while true; do
    clear
    echo "Administración de Procesos"
    echo "1. Listar procesos"
    echo "2. Matar un proceso por ID"
    echo "3. Buscar procesos por nombre"
    echo "4. Volver atrás"
    read -p "Seleccione una opción (1/2/3/4): " opcion

    case $opcion in
        1)
            echo "Listando procesos:"
            ps aux
            read -p "Presione Enter para continuar..."
            ;;
        2)
            read -p "Ingrese el ID del proceso que desea matar: " pid
            kill $pid
            if [ $? -eq 0 ]; then
                echo "El proceso con ID $pid ha sido terminado correctamente."
            else
                echo "Error al intentar terminar el proceso con ID $pid."
            fi
            read -p "Presione Enter para continuar..."
            ;;
        3)
            read -p "Ingrese el nombre del proceso que desea buscar: " proceso
            echo "Buscando procesos con el nombre \"$proceso\":"
            pgrep -l $proceso
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
