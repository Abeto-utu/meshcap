#!/bin/bash

while true; do
    clear
    echo "Administración de Red"
    echo "1. Mostrar información de red"
    echo "2. Configurar una interfaz de red"
    echo "3. Reiniciar red"
    echo "4. Volver atrás"
    read -p "Seleccione una opción (1/2/3/4): " opcion

    case $opcion in
        1)
            echo "Información de red:"
            ip addr
            read -p "Presione Enter para continuar..."
            ;;
        2)
            read -p "Ingrese el nombre de la interfaz de red (por ejemplo, eth0): " interfaz
            read -p "Ingrese la dirección IP (ejemplo, 192.168.1.2): " ip_address
            read -p "Ingrese la máscara de red (ejemplo, 255.255.255.0): " netmask
            read -p "Ingrese la puerta de enlace (ejemplo, 192.168.1.1): " gateway

            # Configurar la interfaz de red
            echo "Configurando la interfaz de red $interfaz..."
            cat <<EOF > /etc/sysconfig/network-scripts/ifcfg-$interfaz
TYPE=Ethernet
BOOTPROTO=static
DEVICE=$interfaz
ONBOOT=yes
IPADDR=$ip_address
NETMASK=$netmask
GATEWAY=$gateway
EOF

            # Reiniciar la interfaz de red
            systemctl restart network

            echo "La interfaz de red $interfaz ha sido configurada correctamente."
            read -p "Presione Enter para continuar..."
            ;;
        3)
            echo "Reiniciando la red..."
            systemctl restart network
            echo "La red ha sido reiniciada correctamente."
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
