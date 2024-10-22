---
layout: cabeza3
---

# Clase QAudioDeviceInfo

La clase QAudioDeviceInfo en Qt proporciona información sobre dispositivos de audio (entrada o salida) disponibles en el sistema. Con esta clase, puedes obtener detalles como los formatos de audio soportados, frecuencias de muestreo y el número de canales.

***

## Características Principales de QAudioDeviceInfo

- Listado de Dispositivos Disponibles: Permite enumerar los dispositivos de audio disponibles en el sistema.
- Formato de Audio Soportado: Proporciona información sobre los formatos de audio soportados, incluyendo frecuencia de muestreo, tamaño de muestra, y canales.
- Compatibilidad de Formatos: Permite verificar si un formato de audio específico es soportado por un dispositivo.
- Dispositivo Predeterminado: Puedes obtener el dispositivo de audio predeterminado tanto para entrada como para salida.

***

## Métodos Principales de QAudioDeviceInfo
1. ### Métodos para Obtener Dispositivos
    - static QList<QAudioDeviceInfo> availableDevices(QAudio::Mode mode)
    Descripción: Devuelve una lista de dispositivos de audio disponibles para el modo especificado (QAudio::AudioInput o QAudio::AudioOutput).

    Ejemplo:

    ```cpp
    QList<QAudioDeviceInfo> devices = QAudioDeviceInfo::availableDevices(QAudio::AudioInput);
    foreach (const QAudioDeviceInfo &deviceInfo, devices) {
        qDebug() << "Dispositivo de entrada:" << deviceInfo.deviceName();
    }
    ```

    - static QAudioDeviceInfo defaultInputDevice()
    Devuelve el dispositivo de audio de entrada predeterminado.

    Ejemplo:
    ```cpp
    QAudioDeviceInfo defaultInput = QAudioDeviceInfo::defaultInputDevice();
    qDebug() << "Dispositivo de entrada predeterminado:" << defaultInput.deviceName();
    ```

    - static QAudioDeviceInfo defaultOutputDevice()
    Devuelve el dispositivo de audio de salida predeterminado.
    
    Ejemplo:
    ```cpp
    QAudioDeviceInfo defaultOutput = QAudioDeviceInfo::defaultOutputDevice();
    qDebug() << "Dispositivo de salida predeterminado:" << defaultOutput.deviceName();
    ```

2. ### Métodos para Consultar Compatibilidad
    - bool isFormatSupported(const QAudioFormat &format) const
    Verifica si un formato de audio específico es compatible con el dispositivo.

    Ejemplo:
    ```cpp
    QAudioFormat format;
    format.setSampleRate(44100);
    format.setChannelCount(2);
    format.setSampleSize(16);
    format.setCodec("audio/pcm");
    format.setByteOrder(QAudioFormat::LittleEndian);
    format.setSampleType(QAudioFormat::SignedInt);

    QAudioDeviceInfo deviceInfo = QAudioDeviceInfo::defaultInputDevice();
    if (deviceInfo.isFormatSupported(format)) {
        qDebug() << "Formato soportado.";
    } else {
        qDebug() << "Formato no soportado.";
    }
    ```

    - QAudioFormat preferredFormat() const
    Devuelve el formato de audio preferido del dispositivo.

    Ejemplo:
    ```cpp
    QAudioDeviceInfo deviceInfo = QAudioDeviceInfo::defaultInputDevice();
    QAudioFormat preferredFormat = deviceInfo.preferredFormat();
    qDebug() << "Frecuencia de muestreo preferida:" << preferredFormat.sampleRate();
    ```

3. ### Métodos para Consultar Capacidades del Dispositivo
    - QString deviceName() const
    Devuelve el nombre del dispositivo de audio.

    Ejemplo:
    ```cpp
    QAudioDeviceInfo deviceInfo = QAudioDeviceInfo::defaultInputDevice();
    qDebug() << "Nombre del dispositivo:" << deviceInfo.deviceName();
    ```

    - QList<int> supportedSampleRates() const
    Devuelve una lista de frecuencias de muestreo soportadas por el dispositivo.

    Ejemplo:
    ```cpp
    QList<int> sampleRates = deviceInfo.supportedSampleRates();
    qDebug() << "Frecuencias de muestreo soportadas:";
    foreach (int rate, sampleRates) {
        qDebug() << rate;
    }
    ```

    - QList<int> supportedSampleSizes() const
    Devuelve una lista de tamaños de muestra soportados por el dispositivo.

    Ejemplo:
    ```cpp
    QList<int> sampleSizes = deviceInfo.supportedSampleSizes();
    qDebug() << "Tamaños de muestra soportados:";
    foreach (int size, sampleSizes) {
        qDebug() << size;
    }
    ```

    - QList<QAudioFormat::Endian> supportedByteOrders() const
    Devuelve una lista de órdenes de bytes soportados (big-endian, little-endian).

    Ejemplo:
    ```cpp
    QList<QAudioFormat::Endian> byteOrders = deviceInfo.supportedByteOrders();
    qDebug() << "Órdenes de bytes soportados:";
    foreach (QAudioFormat::Endian order, byteOrders) {
        qDebug() << (order == QAudioFormat::LittleEndian ? "Little-endian" : "Big-endian");
    }
    ```

***

## Ejemplo Completo
Este ejemplo muestra cómo obtener una lista de dispositivos de entrada de audio, verificar si soportan un formato de audio específico, y listar sus características.

```cpp
#include <QCoreApplication>
#include <QAudioDeviceInfo>
#include <QAudioFormat>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication app(argc, argv);

    // Obtener lista de dispositivos de entrada
    QList<QAudioDeviceInfo> devices = QAudioDeviceInfo::availableDevices(QAudio::AudioInput);
    foreach (const QAudioDeviceInfo &deviceInfo, devices) {
        qDebug() << "Dispositivo de entrada:" << deviceInfo.deviceName();

        // Verificar formato soportado
        QAudioFormat format;
        format.setSampleRate(44100);
        format.setChannelCount(2);
        format.setSampleSize(16);
        format.setCodec("audio/pcm");
        format.setByteOrder(QAudioFormat::LittleEndian);
        format.setSampleType(QAudioFormat::SignedInt);

        if (deviceInfo.isFormatSupported(format)) {
            qDebug() << "Formato soportado.";
        } else {
            qDebug() << "Formato no soportado. Usar formato preferido.";
            format = deviceInfo.preferredFormat();
        }

        // Mostrar características soportadas
        qDebug() << "Frecuencias de muestreo soportadas:" << deviceInfo.supportedSampleRates();
        qDebug() << "Tamaños de muestra soportados:" << deviceInfo.supportedSampleSizes();
        qDebug() << "Órdenes de bytes soportados:" << deviceInfo.supportedByteOrders();
    }

    return app.exec();
}
```

***

## Ejercicios de Consolidación
1.	### Lista de dispositivos
- Crea una aplicación que liste todos los dispositivos de audio disponibles (entrada y salida) y muestre sus nombres.
2.	### Verificación de compatibilidad
- Implementa un programa que permita al usuario ingresar un formato de audio (frecuencia de muestreo, canales, tamaño de muestra) y verifique si el dispositivo de audio predeterminado lo soporta.
3.	###  Información del dispositivo predeterminado
- Escribe una aplicación que muestre todas las características del dispositivo de entrada predeterminado, incluyendo formatos de audio soportados, frecuencias de muestreo, tamaños de muestra, etc.
4.	### Comparación de dispositivos
- Crea un programa que compare las capacidades de dos dispositivos de audio (uno de entrada y otro de salida) y determine si ambos pueden usar el mismo formato de audio.

***

Con esto, cubres los aspectos más importantes de la clase QAudioDeviceInfo en Qt.

