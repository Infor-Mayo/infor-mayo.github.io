---
layout: cabeza3
---

# Clase QAudioInput

La clase QAudioInput en Qt se utiliza para capturar audio desde los dispositivos de entrada, como micrófonos. Es parte del módulo Qt Multimedia, y permite recibir datos de audio en un formato específico y manipularlos o guardarlos en archivos.

***

## Características Principales de QAudioInput
- Captura de Audio: Permite recibir datos de audio en tiempo real desde dispositivos de entrada.
- Configuración del Formato de Audio: Se puede especificar el formato de audio que se recibirá (frecuencia de muestreo, canales, etc.).
- Control del Estado: Permite pausar, reanudar y detener la captura de audio.
- Control de Buffering: Proporciona métodos para gestionar y consultar el buffering de audio.

***

## Métodos Principales de QAudioInput
1. ### Constructores
    - QAudioInput(const QAudioFormat &format, QObject *parent = nullptr)
    Crea una instancia de QAudioInput con el formato de audio especificado.

    Ejemplo:
    ```cpp
    QAudioFormat format;
    format.setSampleRate(44100);   // Frecuencia de muestreo
    format.setChannelCount(2);     // Stereo
    format.setSampleSize(16);      // Tamaño de muestra en bits
    format.setCodec("audio/pcm");
    format.setByteOrder(QAudioFormat::LittleEndian);
    format.setSampleType(QAudioFormat::SignedInt);

    QAudioInput *audioInput = new QAudioInput(format);
    ```
2. ### Control de la Captura de Audio
    - QIODevice* start(QIODevice *device = nullptr)
    
        Inicia la captura de audio y devuelve un dispositivo de entrada (puede ser un archivo o un flujo de datos). 

    Ejemplo:
    ```cpp
    QFile audioFile("captured_audio.raw");
    audioFile.open(QIODevice::WriteOnly);
    audioInput->start(&audioFile);
    ```

    - void stop()

        Detiene la captura de audio.

    Ejemplo:
    ```cpp
    audioInput->stop();
    ```
    - void suspend()

        Suspende la captura de audio.

    Ejemplo:
    ```cpp
    audioInput->suspend();
    ```
    - void resume()

        Reanuda la captura de audio suspendida.

    Ejemplo:
    ```cpp
    audioInput->resume();
    ```

3. ### Control de Volumen
    - void setVolume(qreal volume)

    Ajusta el volumen de captura de audio. El valor debe estar entre 0.0 (silencio) y 1.0 (volumen máximo).

    Ejemplo:
    ```cpp
    audioInput->setVolume(0.8);  // Volumen al 80%
    ```

    - qreal volume() const
    
    Devuelve el volumen de captura actual.

    Ejemplo:
    ```cpp
    qDebug() << "Volumen actual:" << audioInput->volume();
    ```

4. ### Buffering de Audio
    - int bufferSize() const

    Devuelve el tamaño del buffer de audio en bytes.

    Ejemplo:
    ```cpp
    qDebug() << "Tamaño del buffer:" << audioInput->bufferSize();
    ```
    - int bytesReady() const

    Devuelve el número de bytes listos para ser leídos desde el dispositivo de audio.

    Ejemplo:
    ```cpp
    qDebug() << "Bytes listos para ser leídos:" << audioInput->bytesReady();
    ```
    - qint64 readAll()

    Lee todos los datos disponibles desde el dispositivo de audio.

    Ejemplo:
    ```cpp
    QByteArray audioData = audioInput->readAll();
    ```
5. ### Información del Estado de Audio
    - QAudio::State state() const

    Devuelve el estado actual de la captura de audio (QAudio::ActiveState, QAudio::SuspendedState, QAudio::StoppedState, etc.).

    Ejemplo:
    ```cpp
    if (audioInput->state() == QAudio::ActiveState) {
        qDebug() << "Capturando audio.";
    }
    ```

***

## Ejemplo Completo

Este ejemplo muestra cómo crear un objeto QAudioInput, configurar el formato de audio, capturar audio desde un micrófono y guardarlo en un archivo.

```cpp
#include <QCoreApplication>
#include <QAudioInput>
#include <QFile>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication app(argc, argv);

    // Configurar formato de audio
    QAudioFormat format;
    format.setSampleRate(44100);
    format.setChannelCount(2);
    format.setSampleSize(16);
    format.setCodec("audio/pcm");
    format.setByteOrder(QAudioFormat::LittleEndian);
    format.setSampleType(QAudioFormat::SignedInt);

    // Crear QAudioInput
    QAudioInput *audioInput = new QAudioInput(format);

    // Crear archivo para almacenar el audio capturado
    QFile audioFile("captured_audio.raw");
    if (!audioFile.open(QIODevice::WriteOnly)) {
        qDebug() << "No se pudo abrir el archivo para escritura.";
        return -1;
    }

    // Iniciar captura de audio
    audioInput->start(&audioFile);

    return app.exec();
}
```
***

## Ejercicios de Consolidación
1.	### Capturar y guardar audio
- Crea una aplicación que capture audio desde el micrófono y lo guarde en un archivo utilizando QAudioInput. Asegúrate de poder detener la captura y guardar el archivo de forma correcta.
2.	### Control de volumen de entrada
- Modifica el ejercicio anterior para permitir al usuario ajustar el volumen de la captura de audio. Implementa una interfaz simple que controle el nivel de entrada entre 0 y 100%.
3.	###  Indicador de estado de captura
- Implementa una aplicación que muestre el estado de la captura de audio (activo, suspendido, detenido). Asegúrate de que el estado se actualice en tiempo real cuando cambie.
4.	###  Monitoreo del buffer de audio
- Crea una aplicación que monitoree el buffer de entrada de audio, mostrando el tamaño del buffer y los bytes listos para ser leídos en tiempo real.

***

Con esto, has cubierto los aspectos más importantes de la clase QAudioInput, incluyendo sus métodos, ejemplos prácticos y ejercicios para poner en práctica lo aprendido.

