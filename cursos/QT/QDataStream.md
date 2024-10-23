---
layout: cabeza3
---

# Clase QDataStream
QDataStream es una clase que permite la lectura y escritura de datos binarios en dispositivos como archivos, sockets, y otros flujos de entrada/salida. Proporciona una manera eficiente de serializar y deserializar tipos de datos primitivos (como enteros, flotantes, cadenas, etc.) así como tipos de datos de Qt (como QByteArray, QString, QVariant, etc.).

***

## Funcionalidades principales de QDataStream
1. ### Constructores de QDataStream
    - QDataStream(): Crea un flujo de datos sin dispositivo asociado.
    - QDataStream(QIODevice *device): Crea un flujo de datos que opera sobre el dispositivo proporcionado.
    - QDataStream(QByteArray *byteArray, QIODevice::OpenMode mode): Crea un flujo de datos que lee o escribe en un QByteArray.

    Ejemplo:
    ```cpp
    QFile archivo("datos.bin");
    if (archivo.open(QIODevice::WriteOnly)) {
        QDataStream flujo(&archivo);  // Asocia el flujo con el archivo
    }
    ```
2. ### Escribir datos con QDataStream
    QDataStream utiliza el operador << para escribir datos al flujo. Puedes escribir varios tipos de datos: enteros, flotantes, cadenas, arrays, objetos Qt, entre otros.

    Ejemplo:
    ```cpp
    QFile archivo("datos.bin");
    if (archivo.open(QIODevice::WriteOnly)) {
        QDataStream flujo(&archivo);
        int entero = 42;
        double flotante = 3.14;
        QString texto = "Hola, Qt!";
        
        flujo << entero << flotante << texto;  // Escribe datos binarios
        archivo.close();
    }
    ```
3. ### Leer datos con QDataStream
    Para leer datos, puedes usar el operador >>, que funciona de manera similar al operador << para escribir. Debes leer los datos en el mismo orden en que fueron escritos, de lo contrario, los resultados serán incorrectos.

    Ejemplo:
    ```cpp
    QFile archivo("datos.bin");
    if (archivo.open(QIODevice::ReadOnly)) {
        QDataStream flujo(&archivo);
        int entero;
        double flotante;
        QString texto;

        flujo >> entero >> flotante >> texto;  // Lee los datos en el orden correcto
        qDebug() << "Entero:" << entero;
        qDebug() << "Flotante:" << flotante;
        qDebug() << "Texto:" << texto;
        archivo.close();
    }
    ```
4. ### Establecer el formato de los datos
    QDataStream ofrece varios métodos para ajustar el formato de los datos que se leen o escriben, como el byte order (orden de los bytes), el formato de flotantes, y la versión del stream.
    - etByteOrder(QDataStream::ByteOrder): Establece el orden de bytes (BigEndian o LittleEndian).
    - setFloatingPointPrecision(QDataStream::FloatingPointPrecision): Define la precisión de los números flotantes (doble o simple precisión).
    - setVersion(int version): Establece la versión del protocolo de serialización de QDataStream para compatibilidad.

    Ejemplo:
    ```cpp
    QFile archivo("datos.bin");
    if (archivo.open(QIODevice::WriteOnly)) {
        QDataStream flujo(&archivo);

        flujo.setByteOrder(QDataStream::LittleEndian);  // Usa LittleEndian
        flujo.setVersion(QDataStream::Qt_5_15);         // Usa la versión de Qt 5.15

        flujo << (qint32)123456;
        archivo.close();
    }
    ```
5. ### Manipular objetos QByteArray
    Puedes usar QDataStream para escribir y leer directamente en objetos QByteArray. Esto es útil cuando deseas manipular datos en memoria antes de escribirlos en un archivo o enviarlos por una red.

    Ejemplo:
    ```cpp
    QByteArray byteArray;
    QDataStream flujo(&byteArray, QIODevice::WriteOnly);

    flujo << QString("Texto dentro de QByteArray");
    qDebug() << "Contenido del QByteArray:" << byteArray;

    // Leer desde el QByteArray
    QDataStream flujoLectura(&byteArray, QIODevice::ReadOnly);
    QString texto;
    flujoLectura >> texto;
    qDebug() << "Texto leído del QByteArray:" << texto;
    ```
6. ### Serialización de objetos Qt
    QDataStream soporta la serialización de muchos objetos de Qt, como QPoint, QSize, QRect, QColor, QDateTime, entre otros. Esto es especialmente útil para almacenar estructuras de datos complejas.

    Ejemplo:
    ```cpp
    QFile archivo("objetos.bin");
    if (archivo.open(QIODevice::WriteOnly)) {
        QDataStream flujo(&archivo);

        QPoint punto(10, 20);
        QSize tamano(640, 480);

        flujo << punto << tamano;  // Escribe objetos QPoint y QSize
        archivo.close();
    }

    // Leer los objetos de vuelta
    if (archivo.open(QIODevice::ReadOnly)) {
        QDataStream flujo(&archivo);
        QPoint punto;
        QSize tamano;

        flujo >> punto >> tamano;  // Lee los objetos
        qDebug() << "Punto:" << punto;
        qDebug() << "Tamaño:" << tamano;
        archivo.close();
    }
    ```
7. ### Controlar la posición en el flujo
    Puedes moverte dentro del flujo usando QIODevice::seek() para leer o escribir en posiciones específicas dentro del archivo o el dispositivo.
    
    Ejemplo:
    ```cpp
    QFile archivo("datos.bin");
    if (archivo.open(QIODevice::ReadWrite)) {
        QDataStream flujo(&archivo);

        flujo << (qint32)12345;

        archivo.seek(0);  // Mover el puntero al inicio del archivo

        qint32 numero;
        flujo >> numero;
        qDebug() << "Número leído desde la posición 0:" << numero;
        archivo.close();
    }
    ```

***

## Ejemplos prácticos
1. ### Escribir y leer datos binarios
```cpp
#include <QCoreApplication>
#include <QFile>
#include <QDataStream>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    // Escribir datos binarios
    QFile archivo("datos.bin");
    if (archivo.open(QIODevice::WriteOnly)) {
        QDataStream flujo(&archivo);
        qint32 entero = 1234;
        double flotante = 56.78;
        QString texto = "Hola, mundo!";
        
        flujo << entero << flotante << texto;
        archivo.close();
    }

    // Leer datos binarios
    if (archivo.open(QIODevice::ReadOnly)) {
        QDataStream flujo(&archivo);
        qint32 entero;
        double flotante;
        QString texto;

        flujo >> entero >> flotante >> texto;
        qDebug() << "Entero:" << entero;
        qDebug() << "Flotante:" << flotante;
        qDebug() << "Texto:" << texto;
        archivo.close();
    }

    return a.exec();
}
```
2. ### Serializar objetos Qt
```cpp
#include <QCoreApplication>
#include <QFile>
#include <QDataStream>
#include <QDebug>
#include <QPoint>
#include <QSize>

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    // Escribir objetos de Qt en un archivo binario
    QFile archivo("objetos.bin");
    if (archivo.open(QIODevice::WriteOnly)) {
        QDataStream flujo(&archivo);
        QPoint punto(100, 200);
        QSize tamano(640, 480);

        flujo << punto << tamano;
        archivo.close();
    }

    // Leer los objetos de Qt desde el archivo
    if (archivo.open(QIODevice::ReadOnly)) {
        QDataStream flujo(&archivo);
        QPoint punto;
        QSize tamano;

        flujo >> punto >> tamano;
        qDebug() << "Punto:" << punto;
        qDebug() << "Tamaño:" << tamano;
        archivo.close();
    }

    return a.exec();
}
```
3. ### Uso de QByteArray con QDataStream
```cpp
#include <QCoreApplication>
#include <QDataStream>
#include <QByteArray>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    // Escribir en un QByteArray
    QByteArray byteArray;
    QDataStream flujoEscritura(&byteArray, QIODevice::WriteOnly);
    flujoEscritura << QString("Texto dentro de QByteArray");

    qDebug() << "Contenido del QByteArray:" << byteArray;

    // Leer desde un QByteArray
    QDataStream flujoLectura(&byteArray, QIODevice::ReadOnly);
    QString texto;
    flujoLectura >> texto;
    qDebug() << "Texto leído del QByteArray:" << texto;

    return a.exec();
}
```

***

## Ejercicios de Consolidación
1.	Escribir y leer diferentes tipos de datos:
- Crea un programa que escriba en un archivo binario varios tipos de datos (enteros, flotantes, cadenas, arrays) y luego los lea e imprima en consola.
2.	Serialización de objetos Qt:
- Escribe un programa que serialice objetos como QPoint, QSize, QRect, etc., en un archivo binario. Luego, lee los objetos y muestra sus valores en la consola.
3.	Leer y escribir QByteArray:
- Crea un programa que use QByteArray y QDataStream para escribir varios tipos de datos en memoria y luego lea esos datos, imprimiéndolos en consola.
4.	Moverse dentro de un archivo binario:
- Escribe un programa que escriba datos en diferentes posiciones dentro de un archivo binario utilizando seek(). Luego, lee los datos desde posiciones específicas y muéstralos en la consola.

***

Esto cubre las funcionalidades clave de la clase QDataStream. 
