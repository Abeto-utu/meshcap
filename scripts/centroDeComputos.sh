#!/bin/bash

while true; do
    clear
    echo "Menú Principal"
    echo "1. Usuarios y Grupos"
    echo "2. Gestion"
    echo "3. Salir"
    read -p "Seleccione una opción (1/2/3): " opcion

    case $opcion in
        1)
            while true; do
                clear
                echo "Gestión de Usuarios y Grupos"
                echo "1. Gestionar Usuarios"
                echo "2. Gestionar Grupos"
                echo "3. Volver al Menú Principal"
                read -p "Seleccione una opción (1/2/3): " subopcion

                case $subopcion in
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
                        break
                        ;;
                    *)
                        echo "Opción no válida. Por favor, seleccione una opción válida (1/2/3)."
                        read -p "Presione Enter para continuar..."
                        ;;
                esac
            done
            ;;
        2)
            while true; do
                clear
                echo "Gestión"
                echo "1. Realizar Backup Manual"
                echo "2. Gestionar Logs"
                echo "3. Gestionar Procesos"
                echo "4. Gestionar Servicios"
                echo "5. Gestionar Red"
                echo "6. Volver al Menú Principal"
                read -p "Seleccione una opción (1/2/3/4/5/6): " subopcion

                case $subopcion in
                    1)
                        clear
                        echo "Realizando Backup Manual"
                        ./backup.sh
                        read -p "Presione Enter para continuar..."
                        ;;
                    2)
                        clear
                        echo "Gestión de Logs"
                        ./logs.sh
                        read -p "Presione Enter para continuar..."
                        ;;
                    3)
                        clear
                        echo "Gestión de Procesos"
                        ./procesos.sh
                        read -p "Presione Enter para continuar..."
                        ;;
                    4)
                        clear
                        echo "Gestión de Servicios"
                        ./servicios.sh
                        read -p "Presione Enter para continuar..."
                        ;;
                    5)
                        clear
                        echo "Gestión de Red"
                        ./redes.sh
                        read -p "Presione Enter para continuar..."
                        ;;
                    6)
                        break
                        ;;
                    *)
                        echo "Opción no válida. Por favor, seleccione una opción válida (1/2/3/4/5/6)."
                        read -p "Presione Enter para continuar..."
                        ;;
                esac
            done
            ;;
        3)
            exit 0
            ;;
        *)
            echo "Opción no válida. Por favor, seleccione una opción válida (1/2/3)."
            read -p "Presione Enter para continuar..."
            ;;
    esac
done
