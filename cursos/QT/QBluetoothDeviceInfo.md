---
layout: cabeza3
---

# Clase QBluetoothDeviceInfo
La clase QBluetoothDeviceInfo de Qt representa la información de un dispositivo Bluetooth en el entorno del dispositivo local. Proporciona detalles sobre dispositivos Bluetooth disponibles, como su nombre, dirección, clase de dispositivo y capacidades.

***

## Características Principales de QBluetoothDeviceInfo
- Información del dispositivo: Permite acceder a detalles como el nombre, dirección, clase y tipo del dispositivo Bluetooth.
- Servicios soportados: Proporciona los UUIDs de los servicios disponibles en el dispositivo.
- Métodos de conveniencia: Ofrece funciones para verificar si un dispositivo es de bajo consumo (BLE) o si es un dispositivo clásico Bluetooth.

***

## Métodos Principales de QBluetoothDeviceInfo
1. ### Información del Dispositivo
    - QBluetoothDeviceInfo()

    Constructor por defecto que inicializa un objeto vacío.

    Ejemplo:
    ```cpp
    QBluetoothDeviceInfo deviceInfo;
    ```
    - QBluetoothDeviceInfo(const QBluetoothAddress &address, const QString &name, quint32 classOfDevice)

    Constructor que crea un objeto con una dirección, nombre y clase de dispositivo.

    Ejemplo:
    ```cpp
    QBluetoothDeviceInfo deviceInfo(QBluetoothAddress("00:11:22:33:44:55"), "Mi Dispositivo Bluetooth", 0);
    ```
    - QString name() const

    Devuelve el nombre del dispositivo.

    Ejemplo:
    ```cpp
    qDebug() << "Nombre del dispositivo:" << deviceInfo.name();
    ```
    - QBluetoothAddress address() const

    Devuelve la dirección Bluetooth del dispositivo.

    Ejemplo:
    ```cpp
    qDebug() << "Dirección del dispositivo:" << deviceInfo.address().toString();
    ```
    - quint32 classOfDevice() const

    Devuelve la clase del dispositivo Bluetooth.

    Ejemplo:
    ```cpp
    qDebug() << "Clase del dispositivo:" << deviceInfo.classOfDevice();
    ```
2. ### Características del Dispositivo
    - bool isValid() const

    Verifica si el objeto QBluetoothDeviceInfo es válido.

    Ejemplo:
    ```cpp
    if (deviceInfo.isValid()) {
        qDebug() << "El dispositivo es válido.";
    } else {
        qDebug() << "El dispositivo no es válido.";
    }
    ```
    - bool isCached() const

    Devuelve true si el dispositivo está en la caché del sistema.

    Ejemplo:
    ```cpp
    if (deviceInfo.isCached()) {
        qDebug() << "El dispositivo está en caché.";
    }
    ```
    - bool isLowEnergy() const

    Verifica si el dispositivo es Bluetooth de bajo consumo (BLE).

    Ejemplo:
    ```cpp
    if (deviceInfo.isLowEnergy()) {
        qDebug() << "El dispositivo es de bajo consumo.";
    } else {
        qDebug() << "El dispositivo es Bluetooth clásico.";
    }
    ```
3. ### Servicios Bluetooth
    - QList<QBluetoothUuid> serviceUuids() const

    Devuelve una lista de los UUIDs de servicios que soporta el dispositivo.

    Ejemplo:
    ```cpp
    QList<QBluetoothUuid> services = deviceInfo.serviceUuids();
    for (const auto &service : services) {
        qDebug() << "Servicio UUID:" << service.toString();
    }
    ```
4. ### Otros Métodos
    - void setCached(bool cached)

    Establece si el dispositivo debe estar marcado como en caché.

    Ejemplo:
    ```cpp
    deviceInfo.setCached(true);
    ```
    - bool hasService(const QBluetoothUuid &uuid) const

    Verifica si el dispositivo ofrece un servicio específico.

    Ejemplo:
    ```cpp
    QBluetoothUuid uuid = QBluetoothUuid::SerialPort;
    if (deviceInfo.hasService(uuid)) {
        qDebug() << "El dispositivo soporta el servicio de puerto serie.";
    }
    ```

***

## Ejemplo Completo
Este ejemplo busca dispositivos Bluetooth cercanos y muestra información de cada uno utilizando QBluetoothDeviceInfo.
```cpp
#include <QCoreApplication>
#include <QBluetoothDeviceInfo>
#include <QBluetoothDeviceDiscoveryAgent>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication app(argc, argv);

    QBluetoothDeviceDiscoveryAgent *discoveryAgent = new QBluetoothDeviceDiscoveryAgent;

    QObject::connect(discoveryAgent, &QBluetoothDeviceDiscoveryAgent::deviceDiscovered,
                     [](const QBluetoothDeviceInfo &device) {
        qDebug() << "Dispositivo encontrado:";
        qDebug() << "Nombre:" << device.name();
        qDebug() << "Dirección:" << device.address().toString();
        qDebug() << "Clase:" << device.classOfDevice();
        qDebug() << "Es de bajo consumo:" << device.isLowEnergy();
        qDebug() << "Servicios soportados:" << device.serviceUuids();
    });

    discoveryAgent->start();

    return app.exec();
}
```

***

## Ejercicios de Consolidación
1.	Ejercicio 1: Explorador de Dispositivos Bluetooth
- Crea una aplicación que busque dispositivos Bluetooth cercanos y muestre información sobre cada uno, incluyendo su nombre, dirección y si es de bajo consumo.
2.	Ejercicio 2: Filtrado por Servicios
- Modifica la aplicación anterior para que solo muestre los dispositivos que soporten un servicio específico, como el servicio de puerto serie.
3.	Ejercicio 3: Almacenamiento en Caché
- Implementa una aplicación que almacene en caché los dispositivos encontrados y permita al usuario ver la lista de dispositivos caché después de cerrar la búsqueda.
4.	Ejercicio 4: Conexión Automática
- Desarrolla una aplicación que se conecte automáticamente a un dispositivo específico si es encontrado durante la búsqueda, por ejemplo, un dispositivo conocido por su dirección MAC.

***

Estos ejercicios te permitirán reforzar tus conocimientos en la búsqueda y manejo de dispositivos Bluetooth usando la clase QBluetoothDeviceInfo.

