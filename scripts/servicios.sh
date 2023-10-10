#!/bin/bash

while true; do
    clear
    echo "Administración de Servicios"
    echo "1. Iniciar un servicio"
    echo "2. Detener un servicio"
    echo "3. Reiniciar un servicio"
    echo "4. Ver el estado de un servicio"
    echo "5. Listar todos los servicios"
    echo "6. Volver atrás"
    read -p "Seleccione una opción (1/2/3/4/5/6): " opcion

    case $opcion in
        1)
            read -p "Ingrese el nombre del servicio que desea iniciar: " servicio
            systemctl start $servicio
            #$? devuelve 0 si no hubo ningun error en la ejecucion del ultimo comando
            if [ $? -eq 0 ]; then
                echo "El servicio $servicio se ha iniciado correctamente."
            else
                echo "Error al iniciar el servicio $servicio."
            fi
            read -p "Presione Enter para continuar..."
            ;;
        2)
            read -p "Ingrese el nombre del servicio que desea detener: " servicio
            systemctl stop $servicio
            #$? devuelve 0 si no hubo ningun error en la ejecucion del ultimo comando
            if [ $? -eq 0 ]; then
                echo "El servicio $servicio se ha detenido correctamente."
            else
                echo "Error al detener el servicio $servicio."
            fi
            read -p "Presione Enter para continuar..."
            ;;
        3)
            read -p "Ingrese el nombre del servicio que desea reiniciar: " servicio
            systemctl restart $servicio
            if [ $? -eq 0 ]; then
                echo "El servicio $servicio se ha reiniciado correctamente."
            else
                echo "Error al reiniciar el servicio $servicio."
            fi
            read -p "Presione Enter para continuar..."
            ;;
        4)
            read -p "Ingrese el nombre del servicio que desea verificar: " servicio
            systemctl status $servicio
            read -p "Presione Enter para continuar..."
            ;;
        5)
            systemctl list-units --type=service
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
