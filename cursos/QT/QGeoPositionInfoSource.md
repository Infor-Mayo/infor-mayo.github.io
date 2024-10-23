---
layout: cabeza3
---

# Clase QGeoPositionInfoSource
La clase QGeoPositionInfoSource proporciona una interfaz para acceder a los datos de ubicación geográfica del dispositivo. Utiliza diferentes métodos de posicionamiento como GPS, Wi-Fi, torres de telefonía móvil o una combinación de estos para obtener la posición actual.

Esta clase es parte del módulo Qt Location y es clave para desarrollar aplicaciones que requieran información de ubicación, como aplicaciones de navegación o rastreo.
***
## Características Principales
- Acceso a datos de ubicación: Permite obtener la latitud, longitud, altitud y velocidad del dispositivo.
- Actualizaciones periódicas: La clase puede proporcionar actualizaciones continuas de la ubicación a intervalos regulares.
- Fuentes de posicionamiento configurables: Puedes elegir diferentes fuentes de posicionamiento, como GPS, Wi-Fi, etc.
- Interfaz basada en señales: Las actualizaciones de la ubicación se gestionan mediante señales y slots.
***
## Métodos Principales
1. ### Crear una Instancia de QGeoPositionInfoSource
    - static QGeoPositionInfoSource* createDefaultSource(QObject *parent = nullptr)
    
    Crea una fuente de información de posición que utiliza la mejor fuente de posicionamiento disponible en el dispositivo.
    ```cpp
    QGeoPositionInfoSource *source = QGeoPositionInfoSource::createDefaultSource(this);
    ```
2. ### Iniciar y Detener Actualizaciones de Ubicación
    - void startUpdates()

    Inicia la actualización continua de la ubicación del dispositivo.
    ```cpp
    source->startUpdates();
    ```
    - void stopUpdates()

    Detiene las actualizaciones de ubicación.
    ```cpp
    source->stopUpdates();
    ```
3. ### Actualizar la Ubicación una Vez
    - void requestUpdate(int timeout = 5000)

    Solicita una actualización única de la ubicación. Se proporcionará la ubicación actual dentro del tiempo especificado (en milisegundos).
    ```cpp
    source->requestUpdate(10000); // Solicita una actualización única en 10 segundos
    ```
4. ### Obtener la Precisión y la Fuente de Posicionamiento
    - int minimumUpdateInterval() const
    Devuelve el intervalo mínimo de tiempo entre actualizaciones consecutivas de ubicación, en milisegundos.
    - PositioningMethods availablePositioningMethods() const
    Devuelve los métodos de posicionamiento disponibles en el dispositivo (por ejemplo, GPS, Wi-Fi).
    - QGeoPositionInfo lastKnownPosition(bool fromSatellitePositioningMethodsOnly = false) const
    
    Devuelve la última ubicación conocida. Si se pasa el argumento true, solo devuelve la última posición obtenida a través de métodos de posicionamiento por satélite.
5. ### Señales Importantes
    - void positionUpdated(const QGeoPositionInfo &info)

    Emitida cuando hay una nueva actualización de ubicación.
    ```cpp
    connect(source, &QGeoPositionInfoSource::positionUpdated, [](const QGeoPositionInfo &info) {
        qDebug() << "Latitud:" << info.coordinate().latitude();
        qDebug() << "Longitud:" << info.coordinate().longitude();
    });
    ```
    - void updateTimeout()

    Emitida si no se puede obtener una actualización de la posición dentro del tiempo límite especificado.
    - void errorOccurred(QGeoPositionInfoSource::Error error)

    Emitida si ocurre un error en el proceso de obtención de la ubicación.
***
## Ejemplo Completo
Este ejemplo muestra cómo crear una instancia de QGeoPositionInfoSource, comenzar a recibir actualizaciones de ubicación y manejar los datos recibidos.
```cpp
#include <QCoreApplication>
#include <QGeoPositionInfoSource>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    // Crear la fuente de posicionamiento por defecto
    QGeoPositionInfoSource *source = QGeoPositionInfoSource::createDefaultSource(&a);

    if (!source) {
        qDebug() << "No se pudo crear la fuente de posicionamiento.";
        return -1;
    }

    // Conectar la señal de actualización de posición
    QObject::connect(source, &QGeoPositionInfoSource::positionUpdated, [](const QGeoPositionInfo &info) {
        qDebug() << "Latitud:" << info.coordinate().latitude();
        qDebug() << "Longitud:" << info.coordinate().longitude();
    });

    // Iniciar las actualizaciones de ubicación
    source->startUpdates();

    return a.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Rastreo de Movimiento
- Crea una aplicación que muestre las coordenadas de latitud y longitud en tiempo real a medida que el dispositivo se mueve. Además, muestra la velocidad y altitud del dispositivo si está disponible.
2.	### Historial de Ubicación
- Implementa una aplicación que almacene las ubicaciones recibidas en una lista y permita al usuario ver el historial de ubicaciones en un formato de texto o mapa.
3.	### Detección de Errores
- Crea una aplicación que maneje los errores de posicionamiento y muestre mensajes apropiados si no es posible obtener la ubicación, por ejemplo, si el GPS está deshabilitado o no hay acceso a redes Wi-Fi.
***
La clase QGeoPositionInfoSource es esencial para cualquier aplicación que necesite rastrear o mostrar la ubicación geográfica del usuario, como aplicaciones de mapas, rastreo de fitness o geolocalización para servicios.
