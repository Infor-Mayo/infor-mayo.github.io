---
layout: cabeza3
---

# Clase QAccelerometer

La clase QAccelerometer es una especialización de QSensor que permite acceder a los datos del acelerómetro del dispositivo. Un acelerómetro mide la aceleración a lo largo de los tres ejes (X, Y, Z), y es útil para detectar movimiento, inclinación o la orientación del dispositivo.

***

## Características Principales

- Mide aceleración: Proporciona la aceleración en los ejes X, Y y Z.
- Datos en tiempo real: Actualiza continuamente los datos de aceleración del dispositivo.
- Detección de movimientos y orientación: Puede detectar si el dispositivo está inclinado, en reposo o en movimiento.

***

## Métodos Principales

1. ### Constructor
    - QAccelerometer(QObject *parent = nullptr)
    Crea una nueva instancia del acelerómetro. Si el dispositivo tiene un acelerómetro, este comenzará a leer los datos cuando se inicie.

    ```cpp
    QAccelerometer *accelerometer = new QAccelerometer();
    ```

2. ### Iniciar y Detener el Acelerómetro
    - void start()
    Inicia el acelerómetro, comenzando la recolección de datos.
    ```cpp
    accelerometer->start();
    ```

    - void stop()
    Detiene el acelerómetro, finalizando la recolección de datos.

    ```cpp
    accelerometer->stop();
    ```

3. ### Obtener Lectura Actual
    - QAccelerometerReading* reading() const
    Devuelve la lectura actual del acelerómetro. QAccelerometerReading proporciona acceso a los valores de aceleración en los ejes X, Y y Z.
    
    ```cpp
    QAccelerometerReading *reading = accelerometer->reading();
    qDebug() << "X:" << reading->x();
    qDebug() << "Y:" << reading->y();
    qDebug() << "Z:" << reading->z();
    ```

4. ### Cambiar el Modo de Aceleración
    - void setAccelerationMode(QAccelerometer::AccelerationMode mode)

    Cambia el modo de aceleración. Hay dos modos disponibles:
    - QAccelerometer::Gravity: El valor incluye la gravedad terrestre.
    - QAccelerometer::User: Solo muestra la aceleración causada por el usuario.


    ```cpp
    accelerometer->setAccelerationMode(QAccelerometer::Gravity);
    ```

    - QAccelerometer::AccelerationMode accelerationMode() const
    Devuelve el modo de aceleración actual.

5. ### Señal de Cambio de Lectura
    - void readingChanged()
    Señal emitida cuando hay una nueva lectura del acelerómetro. Puedes conectarte a esta señal para procesar los datos en tiempo real.

    ```cpp
    connect(accelerometer, &QAccelerometer::readingChanged, [&]() {
        QAccelerometerReading *reading = accelerometer->reading();
        qDebug() << "X:" << reading->x();
        qDebug() << "Y:" << reading->y();
        qDebug() << "Z:" << reading->z();
    });
    ```
***

## Ejemplo Completo

Este ejemplo muestra cómo iniciar un acelerómetro, leer sus datos en tiempo real y cambiar entre los modos de aceleración.

```cpp
#include <QCoreApplication>
#include <QAccelerometer>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    // Crear el acelerómetro
    QAccelerometer *accelerometer = new QAccelerometer();
    accelerometer->setAccelerationMode(QAccelerometer::User); // Modo 'User'

    // Iniciar el acelerómetro
    accelerometer->start();

    // Conectar la señal de cambio de lectura
    QObject::connect(accelerometer, &QAccelerometer::readingChanged, [&]() {
        QAccelerometerReading *reading = accelerometer->reading();
        qDebug() << "X:" << reading->x();
        qDebug() << "Y:" << reading->y();
        qDebug() << "Z:" << reading->z();
    });

    return a.exec();
}
```

***

## Ejercicios de Consolidación

1.	Detección de Movimiento
    - Crea una aplicación que emita una alerta cuando el dispositivo se mueve bruscamente (por ejemplo, si la aceleración en cualquier eje supera un cierto umbral).

2.	Monitor de Inclinación
    - Implementa una aplicación que utilice los datos del acelerómetro para determinar si el dispositivo está inclinado y muestra un mensaje cuando se detecta una inclinación significativa.

3.	Modo Gravedad vs Modo Usuario
    - Modifica una aplicación para alternar entre los modos QAccelerometer::Gravity y QAccelerometer::User, y muestra cómo varían las lecturas entre estos modos.

***

La clase QAccelerometer es ideal para aplicaciones que necesiten detectar movimiento o cambios de orientación en tiempo real, como aplicaciones de fitness, videojuegos o controladores por gestos.

