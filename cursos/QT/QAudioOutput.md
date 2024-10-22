---
layout: cabeza3
---

# Clase QAudioOutput
QAudioOutput es una clase en Qt que permite gestionar la salida de audio, permitiendo reproducir audio a través de los dispositivos de salida de audio del sistema, como altavoces o auriculares. Es parte del módulo Qt Multimedia, y es muy útil para aplicaciones que necesitan reproducir sonidos o música.

***

## Características Principales de QAudioOutput
- Reproducción de Audio: Permite enviar datos de audio a un dispositivo de salida.
- Configuración de Volumen: Permite ajustar el volumen de salida.
- Control de Estado: Ofrece métodos para iniciar, pausar, reanudar y detener la reproducción de audio.
- Control de Buffering: Proporciona información sobre el buffering del audio para evitar problemas de reproducción.

***

## Métodos Principales de QAudioOutput
1. ### Constructores
    - QAudioOutput(const QAudioFormat &format, QObject *parent = nullptr)

    Crea una instancia de QAudioOutput utilizando un formato de audio específico.

    Ejemplo:
    ```cpp
    QAudioFormat format;
    format.setSampleRate(44100);  // Frecuencia de muestreo
    format.setChannelCount(2);    // Stereo
    format.setSampleSize(16);     // Tamaño de muestra en bits
    format.setCodec("audio/pcm");
    format.setByteOrder(QAudioFormat::LittleEndian);
    format.setSampleType(QAudioFormat::SignedInt);

    QAudioOutput *audioOutput = new QAudioOutput(format);
    ```
2. ### Control de la Reproducción
    - void start(QIODevice *device)

    Inicia la reproducción de audio desde un dispositivo de entrada, como un archivo o un flujo de audio.

    Ejemplo:
    ```cpp
    QFile audioFile(":/sounds/sample.wav");
    audioFile.open(QIODevice::ReadOnly);
    audioOutput->start(&audioFile);
    ```
    void stop()

    Detiene la reproducción de audio.

    Ejemplo:
    ```cpp
    audioOutput->stop();
    ```
    - void suspend()

    Suspende la reproducción de audio.

    Ejemplo:
    ```cpp
    audioOutput->suspend();  // Pausa la reproducción
    ```
    - void resume()

    Reanuda la reproducción de audio suspendida.

    Ejemplo:
    ```cpp
    audioOutput->resume();  // Reanuda la reproducción pausada
    ```
3. ### Control de Volumen
    - void setVolume(qreal volume)

    Ajusta el volumen de la salida de audio. El valor debe estar en el rango de 0.0 (silencio) a 1.0 (máximo volumen).

    Ejemplo:
    ```cpp
    audioOutput->setVolume(0.5);  // Ajusta el volumen al 50%
    ```
    - qreal volume() const

    Devuelve el nivel de volumen actual.

    Ejemplo:
    ```cpp
    qDebug() << "Volumen actual:" << audioOutput->volume();
    ```
4. ### Información del Estado de Audio
    - QAudio::State state() const

    Devuelve el estado actual de la reproducción de audio (QAudio::ActiveState, QAudio::SuspendedState, QAudio::StoppedState, etc.).

    Ejemplo:
    ```cpp
    if (audioOutput->state() == QAudio::ActiveState) {
        qDebug() << "Reproduciendo audio.";
    }
    ```
5. ### Buffering de Audio
    - int bufferSize() const

    Devuelve el tamaño del buffer de audio en bytes.

    Ejemplo:
    ```cpp
    qDebug() << "Tamaño del buffer:" << audioOutput->bufferSize();
    ```
    - int bytesFree() const

    Devuelve la cantidad de bytes libres en el buffer de audio.

    Ejemplo:
    ```cpp
    qDebug() << "Bytes libres en el buffer:" << audioOutput->bytesFree();
    ```

***

## Ejemplo Completo
Este ejemplo muestra cómo crear un objeto QAudioOutput, cargar un archivo de audio, ajustar el volumen y controlar la reproducción.
```cpp
#include <QCoreApplication>
#include <QAudioOutput>
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

    // Crear QAudioOutput
    QAudioOutput *audioOutput = new QAudioOutput(format);

    // Cargar archivo de audio
    QFile audioFile(":/sounds/sample.wav");
    if (!audioFile.open(QIODevice::ReadOnly)) {
        qDebug() << "No se pudo abrir el archivo de audio.";
        return -1;
    }

    // Iniciar la reproducción
    audioOutput->start(&audioFile);

    // Ajustar volumen
    audioOutput->setVolume(0.5);  // Volumen al 50%

    return app.exec();
}
```
***

## Ejercicios de Consolidación
1.	Ejercicio 1: Reproducir un archivo de audio
- Crea una aplicación que cargue y reproduzca un archivo de audio utilizando QAudioOutput. Asegúrate de poder detener, pausar y reanudar la reproducción.
2.	Ejercicio 2: Control de volumen
- Modifica el ejercicio anterior para incluir un control de volumen. Implementa una interfaz simple donde el usuario pueda ajustar el volumen de reproducción entre 0 y 100%.
3.	Ejercicio 3: Indicador de estado de reproducción
- Crea una aplicación que muestre el estado actual de la reproducción de audio (activo, suspendido, detenido). Haz que se actualice en tiempo real cuando el estado cambie.
4.	Ejercicio 4: Manejo del buffer de audio
- Escribe una aplicación que monitoree el estado del buffer de audio durante la reproducción (tamaño del buffer y bytes libres). Ajusta el tamaño del buffer y observa cómo afecta la reproducción.

***

Con esto, has cubierto los aspectos más importantes de la clase QAudioOutput, incluyendo sus métodos más relevantes, ejemplos prácticos y ejercicios para consolidar lo aprendido.

